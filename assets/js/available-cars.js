const rentCarBtnAgencyArr = document.querySelectorAll('.rent-car-btn-agency')

rentCarBtnAgencyArr.forEach(btn => {
	btn.onclick = () => {
		alert('You need to be logged in as a renter to rent out a car.')
	}
})
