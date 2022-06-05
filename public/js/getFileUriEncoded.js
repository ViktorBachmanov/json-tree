export default async function getFileUriEncoded(file) {
    const fileContent = await readFile(file);

    return `json-file=${fileContent}`;
}

function readFile(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsText(file, "UTF-8");
        reader.onload = function (evt) {
            resolve(evt.target.result);
        };
        reader.onerror = function (evt) {
            reject("File read error");
        };
    });
}
