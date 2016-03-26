var renderFileUploaded = function () {
    $('#editJob #logo').on('change', function (e) {
        var logo = this;
        var data = $(logo).val().split('\\');
        var name = data[data.length - 1];
        $('#uploadedFile').text(name);
    });
};

$(function() {
    renderFileUploaded();
});