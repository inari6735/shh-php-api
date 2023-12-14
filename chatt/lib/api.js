import { BASE_URL } from "./config.js";

export function buildUrl(endpoint) {
    return `${BASE_URL}${endpoint}`;
}

export function buildUrlWithParams(endpoint, params) {
    let url = new URL(buildUrl(endpoint));
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
    return url.toString();
}