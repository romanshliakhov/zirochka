import CustomSelect from "../functions/scripts/select";

document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('.main-form__select').forEach(function(item){
    window.selectInstance = new CustomSelect(item, {
      mode: 'single',
      placeholder: item.dataset.placeholder || 'All',
      // showInfo: true,
      showRemoveButton: true,
      name: item.dataset.name,
      hideOnSelect: true,
      hideOnClear: true,

      onSelect: (value) => console.log('Выбрано:', value),
      onRemove: (value) => console.log('Удалено:', value)
    })
  })

  if(window.selectInstance && window.selectInstance.config.name === 'province'){
    const hiddenInputID = document.getElementById('province');

    window.selectInstance.onSelect(function(value){
      hiddenInputID.value = value;
      hiddenInputID.setAttribute('value', value);
    });

    window.selectInstance.onRemove(function(){
      hiddenInputID.value = '';
      hiddenInputID.setAttribute('value', '');
    });
  };
})