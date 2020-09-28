const data = document.getElementById('flash');
let flashData = data.getAttribute('data-flash-data');
let toastData = data.getAttribute('data-toast-data');

if(flashData !== '' && flashData !== null) {
  flashData = flashData.split('|');
}
if(toastData !== '' && toastData !== null) {
  toastData = toastData.split('|');
}

//title = [0]
//text = [1]
// type = [2]

console.log(flashData);

if(flashData !== '' && flashData !== null) {
  Swal.fire({
    icon: flashData[2],
    title: flashData[0],
    text: flashData[1],
    confirmButtonClass: 'btn btn-primary',
    buttonsStyling: false,
  });
} else {
    console.log('false');
}

//title = [0]
//text = [1]
//type = [2]
console.log(toastData);

if(toastData !== '' && toastData !== null) {
  switch(toastData[2]) {
    case 'success':
      toastr.success(toastData[1], toastData[0], { "progressBar": true }); 
      break;
    case 'warning':
      toastr.warning(toastData[1], toastData[0], { "progressBar": true }); 
      break;
    case 'info':
      toastr.info(toastData[1], toastData[0], { "progressBar": true }); 
      break;
    case 'error':
      toastr.error(toastData[1], toastData[0], { "progressBar": true }); 
      break;
  }
} else {
    console.log('false');
}
