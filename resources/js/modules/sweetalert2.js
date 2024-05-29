export default class sweetalert {
    show({ icon = "error", title, timer, showCancelButton = false }) {

        if(icon === "question") {
            showCancelButton = true;
        }

        if(typeof timer === "undefined") {
            switch(icon) {
                case "question":
                case "error":
                    timer = null;
                case "success":
                default:
                    timer = 1500;
            }
        }

        return Swal.fire({
                title : title,
                icon  : icon,
                timer : timer,

                showCancelButton : showCancelButton,
            });
    }

    loading({ title = "Loading..." }) {
        return Swal.fire({
            title: title,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });
    }

    close() {
        return Swal.close();
    }
}