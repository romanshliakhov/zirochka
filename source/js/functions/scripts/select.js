class CustomSelect {
  constructor(element, config = {}) {
    this.container = element
    if (!this.container)
      throw new Error(`Контейнер с селектором "${element}" не найден`)

    this.selectField = this.container.querySelector('.select-field')
    this.optionsContainer = this.container.querySelector('.options-container')
    this.selectedOptionsContainer =
      this.container.querySelector('.selected-options')
    this.selectedValuesContainer =
      this.container.querySelector('.selected-values')

    if (
      !this.selectField ||
      !this.optionsContainer ||
      !this.selectedOptionsContainer
    ) {
      throw new Error('Не найдены все необходимые элементы селекта')
    }

    this.config = {
      mode: config.mode || 'multiple',
      showRemoveButton: config.showRemoveButton !== false,
      placeholder: config.placeholder || 'Выберите элемент',
      onSelect: config.onSelect || null,
      onRemove: config.onRemove || null,
      hideOnSelect: config.hideOnSelect || false,
      hideOnClear: config.hideOnClear || false,
      name: config.name || 'custom-select-value',
      showInfo: config.showInfo === true,
    }

    this.selectedValues = new Set()
    this.suppressEvents = false
    this.isInitialized = false

    this.hiddenInput = document.createElement('input')
    this.hiddenInput.type = 'hidden'
    this.hiddenInput.name = this.config.name
    this.hiddenInput.dataset.filter = this.config.name
    this.container.insertAdjacentElement('afterbegin', this.hiddenInput)

    this.init()

    const form = this.container.closest('form')
    if (form) {
      form.addEventListener('reset', () => {
        setTimeout(() => this.reset(), 0)
      })
    }

    if (this.config.showInfo) {
      this.logAvailableMethods()
    }
  }

  onSelect(callback) {
    this.config.onSelect = callback
  }

  onRemove(callback) {
    this.config.onRemove = callback
  }

  init() {
    this.selectField.addEventListener('click', () => this.toggleDropdown())

    document.addEventListener('click', (e) => {
      if (
        !this.selectField.contains(e.target) &&
        !this.optionsContainer.contains(e.target)
      ) {
        this.closeDropdown()
      }
    })

    const placeholder =
      this.selectedOptionsContainer.querySelector('.placeholder')
    if (placeholder) placeholder.textContent = this.config.placeholder

    this.initOptions()

    const initiallyActive = this.optionsContainer.querySelectorAll(
      '.option.active:not(.disabled)'
    )
    this.suppressEvents = true
    initiallyActive.forEach((option) => {
      const value = option.dataset.value
      if (value) this.setValue(value)
    })
    this.suppressEvents = false

    if (initiallyActive.length > 0) {
      this.container.classList.add('selected')
    }

    this.isInitialized = true
  }

  initOptions() {
    const options = this.optionsContainer.querySelectorAll('.option')

    options.forEach((option) => {
      option.addEventListener('click', () => {
        if (option.classList.contains('disabled')) return

        const value = option.dataset.value

        if (this.selectedValues.has(value)) {
          this.removeValue(value)
          option.classList.remove('active')
        } else {
          if (this.config.mode === 'single' && this.selectedValues.size > 0) {
            const previousValue = Array.from(this.selectedValues)[0]
            this.removeValue(previousValue)
            const previousOption = this.optionsContainer.querySelector(
              `.option[data-value="${previousValue}"]`
            )
            if (previousOption) previousOption.classList.remove('active')
          }

          this.addValue(value)
          option.classList.add('active')

          if (this.config.onSelect && this.isInitialized)
            this.config.onSelect(value)
          if (this.config.mode === 'single' && this.config.hideOnSelect) {
            this.closeDropdown()
          }
        }
      })
    })
  }

  toggleDropdown() {
    this.selectField.classList.toggle('active')
    this.optionsContainer.classList.toggle('active')
  }

  closeDropdown() {
    this.selectField.classList.remove('active')
    this.optionsContainer.classList.remove('active')
  }

  addValue(value) {
    if (this.selectedValues.has(value)) return

    const option = this.optionsContainer.querySelector(
      `.option[data-value="${value}"]`
    )
    if (!option || option.classList.contains('disabled')) return

    this.selectedValues.add(value)

    const icon = option.querySelector('i.sprite')?.cloneNode(true)
    const text = option.querySelector('.option-text')?.textContent || value

    const selectedOption = document.createElement('div')
    selectedOption.className = 'selected-option'
    selectedOption.dataset.value = value

    const content = document.createElement('span')
    content.classList.add('option-label')
    content.textContent = text

    selectedOption.appendChild(icon || document.createElement('span'))
    selectedOption.appendChild(content)

    if (this.config.showRemoveButton) {
      const removeBtn = document.createElement('span')
    //   removeBtn.className = 'icon-clear'
      removeBtn.dataset.value = value
      removeBtn.innerHTML = `
        <svg width="10" height="10" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 12">
          <path fill="currentColor" d="M.2.2a1 1 0 0 1 1.1 0L6 5 10.7.2a.8.8 0 0 1 1 1.1L7.2 6l4.7 4.7a.8.8 0 1 1-1.1 1L6 7.2l-4.7 4.7a.8.8 0 1 1-1-1.1L4.8 6 .2 1.3a.8.8 0 0 1 0-1Z"/>
        </svg>`
      removeBtn.addEventListener('click', (e) => {
        e.stopPropagation()
        this.removeValue(value)
      })
      selectedOption.appendChild(removeBtn)
    }

    const placeholder =
      this.selectedOptionsContainer.querySelector('.placeholder')
    if (placeholder) placeholder.remove()

    this.selectedOptionsContainer.appendChild(selectedOption)
    this.updateSelectedValuesDisplay()
    this.updateHiddenInput()

    this.container.classList.add('selected')
  }

  removeValue(value) {
    this.selectedValues.delete(value)

    const selectedOption = this.selectedOptionsContainer.querySelector(
      `.selected-option[data-value="${value}"]`
    )
    if (selectedOption) selectedOption.remove()

    const option = this.optionsContainer.querySelector(
      `.option[data-value="${value}"]`
    )
    if (option && !option.classList.contains('disabled')) {
      option.classList.remove('active')
    }

    if (this.config.onRemove && !this.suppressEvents)
      this.config.onRemove(value)

    if (this.selectedValues.size === 0) {
      const placeholder = document.createElement('span')
      placeholder.className = 'placeholder'
      placeholder.textContent = this.config.placeholder
      this.selectedOptionsContainer.appendChild(placeholder)
      this.container.classList.remove('selected')

      if (this.config.hideOnClear) {
        this.closeDropdown()
      }
    }

    this.updateSelectedValuesDisplay()
    this.updateHiddenInput()
  }

  updateSelectedValuesDisplay() {
    if (!this.selectedValuesContainer) return
    this.selectedValuesContainer.innerHTML = ''

    if (this.selectedValues.size === 0) {
      const emptyMessage = document.createElement('p')
      emptyMessage.textContent = 'Нет выбранных элементов'
      this.selectedValuesContainer.appendChild(emptyMessage)
      return
    }

    this.selectedValues.forEach((value) => {
      const option = this.optionsContainer.querySelector(
        `.option[data-value="${value}"]`
      )
      if (!option) return

      const icon = option.querySelector('i.sprite')?.cloneNode(true)
      const text = option.querySelector('.option-text')?.textContent || value

      const item = document.createElement('div')
      item.className = 'selected-value-item'

      const label = document.createElement('span')
      label.textContent = text

      item.appendChild(icon || document.createElement('span'))
      item.appendChild(label)

      this.selectedValuesContainer.appendChild(item)
    })
  }

  updateHiddenInput() {
    const values = Array.from(this.selectedValues)
    this.hiddenInput.value =
      this.config.mode === 'multiple' ? values.join('|') : values[0] || ''

    // Триггер событий как у <select>
    this.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }))
    this.hiddenInput.dispatchEvent(new Event('change', { bubbles: true }))
  }

  setValue(value) {
    if (this.config.mode === 'single') this.clear()
    const option = this.optionsContainer.querySelector(
      `.option[data-value="${value}"]`
    )
    if (option && !option.classList.contains('disabled')) {
      this.addValue(value)
      option.classList.add('active')
      if (this.config.onSelect && this.isInitialized)
        this.config.onSelect(value)
      this.updateHiddenInput()
    }
  }

  setValues(values) {
    if (!Array.isArray(values)) return
    if (this.config.mode === 'single') {
      this.setValue(values[0])
    } else {
      values.forEach((value) => {
        const option = this.optionsContainer.querySelector(
          `.option[data-value="${value}"]`
        )
        if (option && !option.classList.contains('disabled')) {
          this.addValue(value)
          option.classList.add('active')
          if (this.config.onSelect && this.isInitialized)
            this.config.onSelect(value)
        }
      })
      this.updateHiddenInput()
    }
  }

  disableOptions(values) {
      if (!Array.isArray(values)) values = [values]
      values.forEach((value) => {
          const option = this.optionsContainer.querySelector(`.option[data-value="${value}"]`)
          if (!option) return

          option.classList.add('disabled')
          option.setAttribute('aria-disabled', 'true')
          
          if (this.selectedValues.has(value)) {
              this.removeValue(value)
          }
      })
  }

  enableOptions(values) {
      if (!Array.isArray(values)) values = [values]
      values.forEach((value) => {
          const option = this.optionsContainer.querySelector(`.option[data-value="${value}"]`)
          if (!option) return

          option.classList.remove('disabled')
          option.removeAttribute('aria-disabled')
      })
  }

  enableAllOptions() {
      const options = this.optionsContainer.querySelectorAll('.option')
      options.forEach((option) => {
          option.classList.remove('disabled')
          option.removeAttribute('aria-disabled')
      })
  }

  clear() {
    this.selectedValues.forEach((value) => this.removeValue(value))
    this.updateHiddenInput()
  }

  reset() {
    this.clear()
  }

  getValues() {
    return Array.from(this.selectedValues)
  }

  logAvailableMethods() {
    const methodNames = Object.getOwnPropertyNames(CustomSelect.prototype)
      .filter(
        (name) => typeof this[name] === 'function' && name !== 'constructor'
      )
      .map((name) => ({
        method: name + '()',
        description: this.getMethodDescription(name),
      }))

    console.groupCollapsed('[CustomSelect] Available methods')
    console.table(methodNames)
    console.groupEnd()
  }

  getMethodDescription(methodName) {
    const descriptions = {
      onSelect: 'Установить callback при выборе',
      onRemove: 'Установить callback при удалении',
      setValue: 'Установить одно значение',
      setValues: 'Установить список значений',
      clear: 'Очистить выбранные значения',
      getValues: 'Получить выбранные значения',
      reset: 'Сбросить выбранные значения (reset формы)',
      toggleDropdown: 'Открыть/закрыть выпадающий список',
      closeDropdown: 'Закрыть выпадающий список',
      addValue: 'Добавить значение вручную',
      removeValue: 'Удалить значение вручную',
      updateSelectedValuesDisplay: 'Перерисовать список выбранных',
      updateHiddenInput: 'Обновить скрытый input',
      init: 'Инициализация плагина',
      initOptions: 'Назначение кликов по options',
      logAvailableMethods: 'Вывести доступные методы',
    }

    return descriptions[methodName] || ''
  }
}

export default CustomSelect
