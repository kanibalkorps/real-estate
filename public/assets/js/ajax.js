function ajax(url, method, successCallback, errorCallback, data = null) {
    let csrfToken = $('meta[name="csrf-token"]').attr('content');

    let headers = {
        'X-CSRF-TOKEN': csrfToken
    };

    let options = {
        url: url,
        dataType: "json",
        success: successCallback,
        error: errorCallback,
        headers: headers
    };

    if (method.toUpperCase() === "GET") {
        options.method = "GET";
    }
    else if (method.toUpperCase() === "POST") {
        options.method = "POST";
        options.contentType = "application/json";
        options.data = JSON.stringify(data);
    }

    $.ajax(options);
}
