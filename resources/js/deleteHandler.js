const deleteFormElements = document.querySelectorAll('form.formDeletable');

deleteFormElements.forEach((formElement) => {
    formElement.addEventListener('submit', function (event) {
        event.preventDefault();
        const formElementName = formElement.getAttribute('data-element-name');
        const confirmAlert = window.confirm(`Sei sicuro di voler eliminare ${formElementName}?`);
        if (confirmAlert) this.submit();
    })
});