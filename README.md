# Badass Backend API

### For Badass Frontend, see https://github.com/Adedoyin-Emmanuel/Badass/

#### Please note the only functional API endpoint is the convertAPI endpoint.


#### Using the simple yet powerful convertio's API, I built my own Convertion API too.

You can also make request to my own API too, 


##### Practical Example On How To Use My API

``` TypeScript

import $ from "jquery";

//this is the format we are converting the file to
const selectedFormat = "jpg";

const handleFileSubmit = (e:Event) =>{

	const files = e.target.files;
	const formData = new FormData(), fileArray = [...files];
	$.ajax({
		 url:`http://localhost/badass-backend/api/convert/?app_id=${Badass.API_KEY}&convert_to=${selectedFormat}`,
		type: "POST",
		data: formData,
		processData: false,
		contentType: false,
		success: (data: any)=>{
			//returns {id, filename, extension, filesize, converting_to : convertingTo, convert_status : convertStatus, message, image_data : imageData}
			const {id, filename, extension, filesize, converting_to : convertingTo, convert_status : convertStatus, message, image_data : imageData} = data;

			/*
				id = fileID, if there are multiple files,
				filename = name of file uploaded,
				extension = file extension
				filesize = filesize,
				converting_to = the filetype you are converting to,
				convert_status = conversion status, returns 200 on success,
				message = returns file conversion successful
				image_data = Blob image file,
			*/

			//create a new blob of an image type after getting the image data from the API
	        const arrayBuffer = new ArrayBuffer(imageData.length);
	        const uintArray = new Uint8Array(arrayBuffer);
	        for (let i = 0; i < imageData.length; i++) {
	          uintArray[i] = imageData.charCodeAt(i);
	        }
	        const blob = new Blob([arrayBuffer], { type: `image/${convertingTo}` }); // Create blob from array buffer
	        const url = URL.createObjectURL(blob); // Create object URL from blob
	        const link = document.createElement('a');
	        link.href = url;
	        link.download = `${filename}_converted.${convertingTo}`;
	        link.click();
		}
	});

}

```


#### Please Note, I also included the RemoveBgAPI in the /apis folder, use at your own risk :) REMOVE.BG api wasn't working so I used another method, if you are interested,see  https://github.com/Adedoyin-Emmanuel/Badass/src/apis/