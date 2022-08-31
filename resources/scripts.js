function changeClass(node, input) {
    if (input.checked) {
        node.classList.add("checkboxToDelete")
    } else {
        node.classList.remove("checkboxToDelete")
    }
}

function skuToDelete() {
    let data = document.querySelectorAll(".checkboxToDelete");
    console.log(data);
    let arrayToDelete = [];
    data.forEach(d => {
        console.log(data);
        arrayToDelete.push( d.childNodes[3].childNodes[1].classList[1] + "." + d.childNodes[3].childNodes[1].textContent);
    })

    return arrayToDelete.join(',');
}
