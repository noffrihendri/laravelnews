  <template>
      <qrcode-stream @decode="onDecode"></qrcode-stream>
  </template>


<script>
  export default {

    methods: {
          onDecode (result) {
          console.log(result)
        }
    }
  }
</script>