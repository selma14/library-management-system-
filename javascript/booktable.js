//SUBMIT SEARCH
const searchForm = document.querySelector(".form-inline");
searchForm.addEventListener("submit",(e)=>{
    e.preventDefault();
})

//CLOSE DELETED ALERT
const close = document.querySelector(".close");
close.addEventListener("click",()=>{
    close.parentNode.setAttribute('hidden',"");
})

//SHOW EDIT WHEN HOVERING ON IT
var editables = document.querySelectorAll('.editable');
for (var i = 0; i < editables.length; i++) {
         var editable = editables[i];
         editable.addEventListener('mouseover', function() {
            this.querySelector('i').style.display = 'inline-block';
         });
         editable.addEventListener('mouseout', function() {
            this.querySelector('i').style.display = 'none';
         });
}