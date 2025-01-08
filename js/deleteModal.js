const deleteModal = document.getElementById('deleteModal')
const confirm = deleteModal.querySelector('#confirm')

if (deleteModal) {
    deleteModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget
        const action = button.getAttribute('data-action')

        confirm.addEventListener('click', () => {
            location.assign(`${action}`)
        })

    })
}