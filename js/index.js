//Select genre form
const selectGenre = document.getElementById('selectGenre');

//on change submit form
selectGenre.addEventListener('change', () => {
    document.getElementById('filterForm').submit();
});