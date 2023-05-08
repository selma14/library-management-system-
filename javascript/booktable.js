//SUBMIT SEARCH
const searchForm = document.querySelector(".form-inline");
searchForm.addEventListener("submit",(e)=>{
    e.preventDefault();
})

//EDIT
$(document).ready(function() {
    $('.editable').hover(
       function() {
          $(this).find('i').show();
       },
       function() {
          $(this).find('i').hide();
       }
    );

}