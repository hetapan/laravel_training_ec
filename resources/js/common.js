$(function () {
    $("#delete").on("click", function () {
        if (confirm("本当に削除しますか？")) {
            return true;
        } else {
            return false;
        }
    });
});

$(function () {
    $("#upload").on("click", function () {
        if (confirm("本当に画像をアップロードしますか？")) {
            return true;
        } else {
            return false;
        }
    });
});
