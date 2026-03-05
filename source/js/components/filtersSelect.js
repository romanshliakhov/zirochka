import CustomSelect from "../functions/scripts/select";

document.addEventListener('DOMContentLoaded', function() {
  const filters = [
    { selector: '#filter-types .custom-select', name: 'types' },
    { selector: '#filter-locations .custom-select', name: 'locations' },
    { selector: '#filter-colors .custom-select', name: 'colors' },
  ];

  filters.forEach(({ selector, name }) => {
    const element = document.querySelector(selector);
    console.log(element);
    if (element) {
      new CustomSelect(element, {
        mode: 'single',
        placeholder: 'All',
        hideOnSelect: true,
        showRemoveButton: false,
        name: name,
        onSelect: (value) => {
          console.log('Выбрано:', value, name);
        }
      });
    }
  });
});
