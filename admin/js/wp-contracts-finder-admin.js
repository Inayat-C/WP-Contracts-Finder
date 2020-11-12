const pull_contracts_from_api = (() => {
	// Vars
	const form = document.querySelector('#contracts-api-form');
	const formData = new FormData(form);
	const params = new URLSearchParams(formData);

	console.log(params);

	form.addEventListener('submit', function(e) {
		e.preventDefault();

		fetch(wp_contracts_finder_ajax.url, {
			method: 'POST',
			body: params,
			credentials: 'same-origin',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
				'Cache-Control': 'no-cache'
			}
		})
			.then(response => {
				return response.json();
			})
			.then(response => {
				// read data here
				console.log('response');
				console.log(response);
			})
			.catch(error => {
				console.log(``);
				console.log(error);
			});
	});
})();
