<html>
  <body>
    <div id="chat">
      <div v-for="message in messages">
        <span v-text="message.created_at"></span>：&nbsp;
        <span v-text="message.body"></span>
      </div>
      <textarea v-model="message"></textarea>
      <br>
      <button type="button" @click="send()">送信</button>
    </div>
    <script src=" {{ mix('js/app.js') }} "></script>
    <script>
      new Vue({
        el: '#chat',
        data: {
          message: '',
          messages: []
        },
        methods: {
          send() {
            const url = '/ajax/chat';
            const params = { message: this.message };
            axios.post(url, params)
              .then((res) => {
                this.message = "";
              })
              .catch(error => console.log(error))
          },
          getMessages() {
            const url = "/ajax/chat";
            axios.get(url)
              .then((res) => {
                this.messages = res.data;
              })
          }
        },
        mounted() {
          this.getMessages();
          Echo.channel('chat')
            .listen('MessageCreated', (e) => {
                this.getMessages();
            });
        }
      });
    </script>
  </body>
</html>