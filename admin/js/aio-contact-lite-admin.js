(function () {

    document.addEventListener("DOMContentLoaded", function(){
        setActiveLinks()
        loadEventListener()
    })

    function setActiveLinks() {
        let url = window.location.href.split('#')[0]
        let links = document.querySelectorAll('.aio-contact-menu a')
        links.forEach(link => {
            if(link.href === url) {
                link.classList.add('active')
            }
        })
    }

    function getItems() {
        return JSON.parse(document.getElementById('aio-contact-items').innerHTML)
    }

    function setItems(items) {
        document.getElementById('aio-contact-items').innerHTML = JSON.stringify(items)
    }

    function saveItems() {
        callAction('save_aio_contact_lite_items',  { 
            payload: document.getElementById('aio-contact-items').innerHTML
        })
    }

    function clearModalForm() {
        //Clearing Item Fields
        document.getElementById('item_title').value = ''
        document.getElementById('item_icon').value = ''
        document.querySelector('input[name=item_icon]').value = ''
        let icon = document.querySelector('[name=item_icon]')
        if(icon.querySelector('i')) {
            icon.querySelector('i').className = ''
            //document.querySelector('.iconpicker-popover .search-control').value = ''
        }
        document.getElementById('item_url').value = ''
    }

    function reStructure() {
        document.querySelectorAll('.aio-contact-items > .col-xl-3').forEach(item => {
            item.remove()
        })
        let items = getItems()
        items.forEach((item, item_id, items) => {
			addItemToDOM(item, item_id)
            if(item_id == items.length - 1) {
                reLoadEventListener()
            }
        })
    }

    /** Event Listeners */

    function loadEventListener() {
        saveItemsBtn()
        borderRadiusField()
        clearFieldsOnModalClose()
        sampleImport()
        itemActions()
        removeItem()
        clearPreloader()
    }

    function reLoadEventListener() {
        removeItem()
    }

    function clearPreloader() {
        if(document.querySelector('.aio-contact-preloader')) {
            document.querySelector('.aio-contact-preloader').remove()
        }
    }

    function saveItemsBtn() {
        if(document.getElementById('aio-contact-save-items')) {
            document.getElementById('aio-contact-save-items').addEventListener('click', () => {
                reStructure()
                saveItems()
            })
        }
    }

    function borderRadiusField() {
        let range = document.getElementById('border_radius')
        let value = document.getElementById('border_radius_value')
        if(range) {
            range.addEventListener('input', () => {
                value.value = range.value
            })
            value.addEventListener('change', () => {
                range.value = value.value
            })
        }
    }

    function clearFieldsOnModalClose() {
        document.querySelectorAll('[data-dismiss="modal"]').forEach(trigger => {
            trigger.addEventListener('click', () => {
                clearModalForm()
            })
        })
    }

    function sampleImport() {
        if(document.querySelector('.aio-contact-import-sample-items')) {
            document.querySelector('.aio-contact-import-sample-items').addEventListener('click', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will be able to delete the items which you don't need later",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, import!'
                }).then((result) => {
                    if (result.value) {
                        let items = JSON.parse('[{"title":"WhatsApp","icon":"fab fa-whatsapp","color":"#1bd741","url":""},{"title":"Telegram","icon":"fab fa-telegram","color":"#0088cc","url":""},{"title":"Skype","icon":"fab fa-skype","color":"#01aee6","url":""},{"title":"Messenger","icon":"fab fa-facebook-messenger","color":"#0185ff","url":""},{"title":"Viber","icon":"fab fa-viber","color":"#7f51a4","url":""},{"title":"Email","icon":"fas fa-envelope","color":"#d80039","url":""}]')
                        setItems(items)
                        saveItems()
                        reStructure()
                        document.querySelector('.aio-contact-import-sample-items').remove()
                        Swal.fire(
                            'Imported!',
                            'Item has been successfully imported',
                            'success'
                        )
                    }
                })
            })
        }
    }

    function itemActions() {
        if(document.getElementById('item_modal_action')) {
            document.getElementById('item_modal_action').addEventListener('click', () => {
                let action = document.getElementById('item_modal_action')
                if(action.innerText.search('Add') !== -1) {
                    addItem(action.dataset.type)
                } else if(action.innerText.search('Edit') !== -1) {
                    editItem(action.dataset.type)
                }
            })
        }
    }

    function addItem(type) {
        if(document.getElementById('item_title').value === '') {
            Swal.fire(
                'Incomplete Fields!',
                'Item Title cannot be blank',
                'error'
            )
            return
        }
        let items = getItems()
        let item = {
            "title": document.getElementById('item_title').value,
            "icon": document.querySelector('input[name=item_icon]').value,
            "color": document.getElementById('item_color').value
        }
        if(item.icon === '' || item.icon === 'empty') {
            item.icon = 'fas fa-stop'
        }
		item.url = document.getElementById('item_url').value
        items.push(item)

        addItemToDOM(item, items.length - 1)
        setItems(items)
        saveItems()
        clearModalForm()
        reLoadEventListener()

        document.querySelector('.show [data-dismiss="modal"]').click()
        Swal.fire({
            title: 'Success',
            text: `New Item has been added successfully.`,
            type: 'success',
            showConfirmButton: false,
            timer: 2000
        })
    }

    function addItemToDOM(item, index) {
        let element = document.createElement('div')
        element.classList.add('col-xl-3', 'col-lg-4', 'col-md-6')
        element.id = `aio-contact-item-${index}`
        element.innerHTML = `
            <div class="aio-contact-item">
                <div class="aio-contact-item-header">
                    <div class="aio-contact-item-text">
                        <div class="aio-contact-item-icon" style="color: ${item.color}"> 
                            <i class="${item.icon}"></i>
                        </div>
                        <div class="aio-contact-item-title">
                            ${item.title}
                        </div>
                    </div>
                    <div class="aio-contact-item-actions">
                        <div class="aio-contact-item-action aio-contact-item-action-edit text-success hvr-bob" data-id="${index}">
                            <i class="fas fa-edit"></i>
                        </div>
                        <div class="aio-contact-item-action aio-contact-item-action-delete text-danger hvr-bob" data-id="${index}">
                            <i class="fas fa-trash"></i>
                        </div>
                    </div>
                </div>
            </div>
        `
        document.querySelector('.aio-contact-items').insertBefore(element, document.querySelector('.aio-contact-item-add').parentElement)
    }

    function editItem(type) {
        if(document.getElementById('item_title').value === '') {
            Swal.fire(
                'Incomplete Fields!',
                'Item Title cannot be blank',
                'error'
            )
            return
        }
        let items = getItems()
        let item_id = document.getElementById('item_modal_action').dataset.id
        items[item_id].title = document.getElementById('item_title').value
        items[item_id].icon = document.querySelector('input[name=item_icon]').value
        items[item_id].color = document.getElementById('item_color').value
        items[item_id].url = document.getElementById('item_url').value
        if(items[item_id].icon === '' || items[item_id].icon === 'empty') {
            items[item_id].icon = 'fas fa-stop'
        }

        editItemInDOM(items[item_id], item_id)
        setItems(items)
        saveItems()
        clearModalForm()

        document.querySelector('.show [data-dismiss="modal"]').click()
        Swal.fire({
            title: 'Success',
            text: `Item has been edited successfully.`,
            type: 'success',
            showConfirmButton: false,
            timer: 2000
        })
    }

    function editItemInDOM(item, item_id) {
        let element = document.getElementById(`aio-contact-item-${item_id}`)
        element.querySelector('.aio-contact-item-icon').style.color = item.color
        element.querySelector('.aio-contact-item-icon i').className = item.icon
        element.querySelector('.aio-contact-item-title').innerHTML = item.title
    }

    function removeItem() {
        document.querySelectorAll('.aio-contact-item-action-delete').forEach(item => {
            item.addEventListener('click', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        let items = JSON.parse(document.getElementById('aio-contact-items').innerHTML)
                        items.splice(item.dataset.id, 1)
                        document.getElementById(`aio-contact-item-${item.dataset.id}`).remove()
                        document.getElementById('aio-contact-items').innerHTML = JSON.stringify(items)
                        saveItems()
                        reStructure()
                        Swal.fire({
                            title: 'Success',
                            text: `Item has been deleted successfully.`,
                            type: 'success',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                })
            })
        })
    }

    /** Commong Action Call Function */

    async function callAction(action, data = {}) {
        if(action) {
            const response = await fetch(ajax_object.ajax_url, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=${action}&data=${JSON.stringify(data)}`,
            }).catch(e => {
                Swal.fire({
                    title: 'Oops...',
                    text: "We couldn't save your last action. Please refresh to continue",
                    type: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Refresh'
                }).then((result) => {
                    if (result.value) {
                        location.reload()
                    }
                })
            })
        }
    }

})()