const data = document.getElementById('flash');
console.log(data);
let flashData = data.getAttribute('data-flash-data').split('|');

//title = [0]
//text = [1]
// type = [2]

if(flashData[0] !== '') {
  Swal.fire({
    title: "Good job!",
    text: "You clicked the button!",
    type: "success",
    confirmButtonClass: 'btn btn-primary',
    buttonsStyling: false,
  });
} else {
    console.log('false');
}
