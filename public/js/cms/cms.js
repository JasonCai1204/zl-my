function confirmDelete() {
    var sign = prompt('键入 "DELETE" 来删除：');

    if (sign == "DELETE") {
        $('#deleteForm').submit();
    } else if (sign != null) {
        alert("键入有误，删除失败。");
    }
}
