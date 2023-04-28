const app = Vue.createApp({
    data() {
        return {
            messages: [],
            newMessage: "",
        };
    },

    watch: {
        messages() {
                setTimeout(() => {
                    this.fetchMessages()
                }, 1500)
        }
    },

    mounted() {
        this.fetchMessages();
    },
    methods: {
        fetchMessages() {
            fetch("/fetch-message.php")
                .then((response) => response.json())
                .then((data) => {
                    this.messages = data;
                })
                .catch((error) => {
                    console.error(error);
                });
        },
        sendMessage() {
            fetch("add-message.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({message: this.newMessage}),
            })
                .then((response) => response.json())
                .then((data) => {
                    console.log(JSON.stringify({message: this.newMessage}),)
                    this.messages.push(data);
                    this.newMessage = "";
                })
                .catch((error) => {
                    console.error(error);
                });
        },
    },
});

app.mount("#app");
