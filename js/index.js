//Select genre form
const selectGenre = document.getElementById('selectGenre');

//on change submit form
selectGenre.addEventListener('change', () => {
    document.getElementById('filterForm').submit();
});

//select search bar
// const searchByText = document.getElementById('textFilter')

//submit on every change
// searchByText.addEventListener('change', () => {
//     document.getElementById('textFilterForm').submit();

// })