import axios from 'axios';

const token = document.querySelector('input[name="_token"]').value
const axiosConfig = {
  headers: {
    'X-CSRF-TOKEN': token
  }
}
const deleteTaskButtons = document.querySelectorAll('.button.delete')
const shareTaskButtons = document.querySelectorAll('.button.share')
const liveUpdateFields = document.querySelectorAll('.live-update')
const contentEditableElements = document.querySelectorAll('.task [contenteditable="true"]')
const closeShareTaskDialog = document.querySelector('#closeShareTaskDialog')
const copyShareTaskDialog = document.querySelector('#copyShareTaskDialog')
const shareTaskDialog = document.querySelector('#shareTaskDialog')
const shareTaskLink = document.querySelector('#shareTaskLink')
const priorityOptions = ['low', 'medium', 'high']

const handleTaskDelete = async (event) => {
  const task = event.target.closest('.task')
  const taskId = task.getAttribute('data-task-id')

  try {
    await axios.post(`/task/delete/${taskId}`, axiosConfig)
    task.remove()
  } catch (error) {
    throw new Error(error.message)
  }
}

if(deleteTaskButtons){
  deleteTaskButtons.forEach(button => {
    button.addEventListener('click', handleTaskDelete)
  })
}

const handleTaskUpdate = async (event) => {
  const task = event.target.closest('.task')
  const taskId = task.getAttribute('data-task-id')
  const attributeName = event.target.getAttribute('data-name')
  const attributeValue = event.target.value?? event.target.innerText

  try {
    const response = await axios.post(`/task/update/${taskId}`, {
      [attributeName]: attributeValue
    }, axiosConfig)

    if(attributeName === 'priority') {
      task.classList.remove(...priorityOptions)
      task.classList.add(attributeValue)
    }
  } catch (error) {
    const errorMessageContainer = task.querySelector('.error-message')

    if (error.response && error.response.data && error.response.data.message) {
      errorMessageContainer.innerText = error.response.data.message
    } else {
      errorMessageContainer.innerText = 'Podczas aktualizacji zadania wystąpił błąd.'
    }
    errorMessageContainer.innerText = error.message
    throw new Error(error.message)
  }
}

if(liveUpdateFields){
  liveUpdateFields.forEach(field => {
    field.addEventListener('change', handleTaskUpdate)
  })
}

if(contentEditableElements){
  let updateEditableElementsTimeout
  contentEditableElements.forEach(contentEditableElement => {
    contentEditableElement.addEventListener('input', (event) => {
      clearTimeout(updateEditableElementsTimeout)

      updateEditableElementsTimeout = setTimeout(()=> {
        handleTaskUpdate(event).catch(error => {
          throw new Error(error.message)
        })
      }, 500)
    })
  })
}

const handleTaskShare = async (event) => {
  const taskId = event.target.closest('.task').getAttribute('data-task-id');

  try {
    const response = await axios.post(`/task/share/${taskId}`, axiosConfig)
    const link = response.data.link
    shareTaskDialog.classList.add('show')
    shareTaskLink.innerHTML = link
    shareTaskLink.href = link

    if (navigator.clipboard && window.isSecureContext){
      copyShareTaskDialog.classList.add('show')
      copyShareTaskDialog.addEventListener('click', event => {
        shareTaskLink.closest('.link-container').classList.add('copied')
      })

      navigator.clipboard.writeText(link).then(() => {
        shareTaskLink.classList.add('copied')
      })
    }
  } catch (error) {
    throw new Error(error.message)
  }
}
if(shareTaskButtons){
  shareTaskButtons.forEach(button => {
    button.addEventListener('click', handleTaskShare)
  })
}

if(closeShareTaskDialog){
  closeShareTaskDialog.addEventListener('click', event => {
    shareTaskDialog.classList.remove('show')
  })
}

