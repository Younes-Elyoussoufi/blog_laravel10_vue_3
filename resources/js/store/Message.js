import Swal from 'sweetalert2'

function Message(msg='you must be login please!!',type,color){
    const Toast = Swal.mixin({
        toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000,
     timerProgressBar: true,
     didOpen: (toast) => {
       toast.addEventListener('mouseenter', Swal.stopTimer)
       toast.addEventListener('mouseleave', Swal.resumeTimer)
     }
     })
   
   Toast.fire({
     icon: type,
     title: msg,
     color:color,
      
   })
   setInterval(()=>{},3000)
}

export default Message
