<script>
function searchBook() {
    let q = document.getElementById('q').value;
    fetch('../ajax/searchBook.php?q=' + q)
    .then(res => res.json())
    .then(data => {
        let html = '';
        data.forEach(b => {
            html += `<p>${b.title} - ${b.author}</p>`;
        });
        document.getElementById('result').innerHTML = html;
    });
}
</script>

<input type="text" id="q" onkeyup="searchBook()" placeholder="Search book">
<div id="result"></div>
