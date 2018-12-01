const axios = require("axios");

let imageEdit = {
	imageUpload(inputFile, imageOutput, callback) {
		inputFile.click();
		
		inputFile.addEventListener('change', function (event) {
			let input = event.target;
			
			let reader = new FileReader();
			reader.onload = function () {
				imageOutput.src = reader.result;
			};
			reader.readAsDataURL(input.files[0]);
			
			callback && callback();
		});
	},
	
	imageUploadAjax(url, imageOutput){
		let inputElement = document.createElement('input');
		inputElement.type = 'file';
		inputElement.name = 'imageUpload';
		inputElement.accept="image/*";
		
		inputElement.click();
		inputElement.addEventListener('change', function (event) {
			let input = event.target;
			let formData = new FormData();
			let fileData = input.files[0];
			formData.append(input.name, fileData);
			console.log(url);
			
			axios.post(url, formData)
				.then(function (response) {
					console.log(response);
					let reader = new FileReader();
					reader.onload = function () {
						if (imageOutput instanceof HTMLCollection){
							for (let item of imageOutput) {
								item.src = reader.result;
							}
						}
						else{
							imageOutput.src = reader.result;
						}
					};
					reader.readAsDataURL(fileData);
				})
				.catch(function (response) {
					console.log(response);
				})
		})
	},
	
	imageDelete(pathDelete, imageOutput, callback) {
		axios.post(pathDelete)
			.then(function () {
				if (imageOutput instanceof HTMLCollection){
					for (let item of imageOutput){
						item.src = '/files/images/no-foto.jpg';
					}
				}
				else{
					imageOutput.src = '/files/images/no-foto.jpg';
				}
				callback && callback();
			})
			.catch(function (response) {
				console.log(response);
		});
	}
};

module.exports = imageEdit;