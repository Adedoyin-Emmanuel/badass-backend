# Badass Backend API
## A Tool For Image Manipulation :)

### Table Of Content

- [Introduction](#Introduction)
  - [Technologies](#Technologies)
  - [Frontend Project](#Fronted-Project)
  - [Live Site](#Live-Site)
  - [Custom Backend API](#Backend-API)
  - [Author](#author)

#### Introduction

Badass is an application built for image manipulation, with Badass, you can **Remove image background**, **Convert image files from one format to another**, **Download multiple images at once**. Now you might ask me, why did i build **Badass**? well I discovered when working on any project, I do 3 things almost everytime, 

1. Downloading multiple image assets for my project.
2. Twerking some images **eg** removing the background
3. Converting image files from one form to another eg converting **.png** to **.ico** for **favicon** or converting **.png** to **.svg**  

And usually I spend too much time on this surfing the web for good assets and all, so I built a tool to do it all for me!

#### Technologies

- **ReactJS**
- **Typescript**
- **PWA Technology**
- **Bootstrap 5**
- **Vanilla CSS**
- **Jquery**
- **PHP**
- **Composer Tool**

#### Frontend-Project
**see https://github.com/Adedoyin-Emmanuel/badass**


#### Live-Site
 **[Badass App](https://badass-app.vercel.app/)**

#### Backend-API

How to make request to my custom backend API
``` TypeScript

import $ from "jquery";

//this is the format we are converting the file to
const selectedFormat = "jpg";

const handleFileSubmit = (e:Event) =>{

	const files = e.target.files;
	const formData = new FormData(), fileArray = [...files];
	$.ajax({
		 url:`http://testbasedev.000.webhostapp.com/badass-backend/api/convert/?app_id=${Badass.API_KEY}&convert_to=${selectedFormat}`,
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


#### Author

Adedoyin Emmanuel Adeniyi

*follow me* **[@Twitter](https://twitter.com/Emmysoft_Tm/)**