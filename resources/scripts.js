function changeClass(node, input) {
    if (input.checked) {
        node.classList.add("delete-checkbox")
    } else {
        node.classList.remove("delete-checkbox")
    }
}

function skuToDelete() {
    let data = document.querySelectorAll(".delete-checkbox");
    let arrayToDelete = [];
    data.forEach(d => {
        arrayToDelete.push( d.childNodes[3].childNodes[1].classList[1] + "." + d.childNodes[3].childNodes[1].textContent);
    })

    let str = arrayToDelete.join(',');
    console.log(arrayToDelete.join(','));
    return str;
}
