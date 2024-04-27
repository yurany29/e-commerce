import { ref } from 'vue'

export default function handlerModal() {
	const modal = ref(null)
	const load_modal = ref(false)

	const moutedModal = async (status = true) => {
		return await new Promise((resolve, reject) => {
			load_modal.value = status
			setTimeout(() => resolve(), 200)
		})
	}

	const openModal = async modal_id => {
		await moutedModal()
		modal.value = new bootstrap.Modal(`#${modal_id}`)
		modal.value.show()
	}

	const closeModal = async () => {
		modal.value.hide()
		await moutedModal(false)
	}

	return {
		load_modal,
		closeModal,
		openModal
	}
}