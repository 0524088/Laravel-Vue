// 包裝 es6 fetch
async function $fetch({ url, method, data = null, useToken = null }) {
    let header = { "Content-Type": "application/json" };
    if (useToken === true) {
        const token = 1; // token
        header.Authorization = `Bearer ${token}`;
    }
    try {
        const response = await fetch(url, {
            method: method,
            ...(header !== null && { headers: header }),
            ...(data !== null && { body: JSON.stringify(data) })
        });

        if (!response.ok) {
            throw new Error("$fetch 響應失敗");
        }
    
        return response.json();

    } catch (error) {
        console.error("$fetch 提交錯誤：", error);
    }
}