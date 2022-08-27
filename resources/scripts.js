function changeClass(node, input) {
    if (input.checked) {
        node.classList.add("delete-checkbox")
    } else {
        node.classList.remove("delete-checkbox")
    }
}