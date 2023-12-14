async function fetchBase(url, options = {}) {
    const defaultHeaders = {};

    if (!(options.body instanceof FormData)) {
        defaultHeaders['Content-Type'] = 'application/json';
    }

    if (options.credentials === undefined) {
        options.credentials = 'include';
    }

    const response = await fetch(url, {
        ...options,
        headers: {
            ...defaultHeaders,
            ...options.headers,
        }
    });

    const data = await response.json();

    if (!response.ok) {
        throw new Error(data.message || 'Error with the fetch call');
    }
    
    return data;
}

export function fetchGet(url) {
    return fetchBase(url)
}

export function fetchPost(url, body = {}) {
    return fetchBase(url, {
        method: 'POST',
        body: JSON.stringify(body),
        credentials: 'include'
    });
}

export function fetchPostWithFiles(url, files, otherData = null) {
    const formData = new FormData();

    files.forEach((file) => {
        formData.append(`files[]`, file);
    });

    if (otherData) {
        Object.keys(otherData).forEach(key => {
            formData.append(key, otherData[key]);
        });
    }

    return fetchBase(url, {
        method: 'POST',
        body: formData,
    });
}

export function fetchPut(url, body) {
    return fetchBase(url, {
        method: 'PUT',
        body: JSON.stringify(body),
    });
}

export function fetchDelete(url) {
    return fetchBase(url, {
        method: 'DELETE',
    });
}
