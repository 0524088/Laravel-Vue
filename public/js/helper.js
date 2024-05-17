// 包裝 es6 fetch
async function $fetch({ url, method, data = null, useToken = true, origin = false, notApi = false }) {
    let header = { "Content-Type": "application/json" };
    if (useToken === true) {
        header.Authorization = `Bearer ${localStorage.getItem("token")}`;
    }
    try {
        if (!notApi) {
            url = `/api/${url}`;
        }

        const response = await fetch(url, {
            method: method,
            ...(header !== null && { headers: header }),
            ...(data !== null && { body: JSON.stringify(data) })
        });

        if (!response.ok) {
            throw new Error("$fetch 響應失敗");
        }

        if (origin === true) {
            return response;
        }

        return response.json();

    } catch (error) {
        console.error("$fetch 提交錯誤：", error);
    }
}