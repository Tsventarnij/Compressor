import http from "../http-common";


const getCompressed = data => {
    return http.get(`/compress`, {params : data});
};
const getDecompressed = data => {
    return http.get(`/decompress`, {params : data});
};

export default {
    getCompressed,
    getDecompressed
};