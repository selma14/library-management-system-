//SUBMIT SEARCH
const searchForm = document.querySelector(".form-inline");
searchForm.addEventListener("submit",(e)=>{
    e.preventDefault();
    searchTable();
})

function searchTable() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those that don't match the search query
    for (i = 0; i < tr.length; i++) {
      // Only search in bookTitle and author columns
      td_bookTitle = tr[i].getElementsByTagName("td")[2];
      td_author = tr[i].getElementsByTagName("td")[3];
      if (td_bookTitle || td_author) {
        txtValue_bookTitle = td_bookTitle.textContent || td_bookTitle.innerText;
        txtValue_author = td_author.textContent || td_author.innerText;
        if (
          txtValue_bookTitle.toUpperCase().indexOf(filter) > -1 ||
          txtValue_author.toUpperCase().indexOf(filter) > -1
        ) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

    input.addEventListener("blur",()=>{
        for (i = 0; i < tr.length; i++){
            tr[i].style.display = "";
        }
    })
  }

//CLOSE DELETED ALERT
const close = document.querySelector(".close");
close.addEventListener("click",()=>{
    close.parentNode.setAttribute('hidden',"");
})

