csrfToken();

const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
  
	token = $('meta[name="csrf-token"]').attr('content');
	const xhr = new XMLHttpRequest();

	xhr.withCredentials = false;
	xhr.open('POST', '/admin/ajax/uploadImageTinymce');
	xhr.setRequestHeader("X-CSRF-Token", token);

  	xhr.upload.onprogress = (e) => {
    	progress(e.loaded / e.total * 100);
  	};

  	xhr.onload = () => {
    	if (xhr.status === 403) {
      		reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
      	return;
    	}

    	if (xhr.status < 200 || xhr.status >= 300) {
      		reject('HTTP Error: ' + xhr.status);
      		return;
    	}

    	const json = JSON.parse(xhr.responseText);

    	if (!json || typeof json.location != 'string') {
      		reject('Invalid JSON: ' + xhr.responseText);
      		return;
    	}

    	resolve(json.location);
};

  	xhr.onerror = () => {
    	reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
  	};

  	const formData = new FormData();
  	formData.append('file', blobInfo.blob(), blobInfo.filename());

  	xhr.send(formData);
});

tinymce.init({
	selector: '.tinymce',
	language: 'bg_BG',
	height: 650,
    // browser_spellcheck: true,
	// contextmenu: false,
	plugins: 'preview searchreplace autolink directionality visualblocks visualchars image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap code',
	toolbar: 'undo redo bold italic underline strikethrough charmap pagebreak code alignleft aligncenter alignright alignjustify numlist bullist table insertfile image media link forecolor backcolor removeformat preview searchreplace help',
	menubar: '', //'file edit view insert format tools table help',
	toolbar_mode: 'floating',
	contextmenu: 'link image table',
	images_upload_url: '/admin/ajax/uploadImageTinymce',
	images_upload_base_path: '',
	relative_urls: false,
	remove_script_host: true,
	convert_urls: true,
	automatic_uploads: true,
	// init_instance_callback: 'insert_contents',
	images_upload_handler: example_image_upload_handler,	
	file_picker_types: 'image',
});