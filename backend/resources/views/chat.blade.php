<html>
  <head>
    <style>
      #message {
        width: 100%;
      }
      #message > .inner {
        width: 1200px;
        margin: 0 auto;
      }
    </style>
  </head>
  <body>
    <section id="message">
      <div id="chat" class="inner">
        <div v-for="message in messages">
          <span v-text="message.created_at"></span>：&nbsp;
          <span v-text="message.body"></span>
        </div>
        <textarea v-model="message"></textarea>
        <br>
        <button type="button" @click="send()">送信</button>
      </div>
    </section>

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