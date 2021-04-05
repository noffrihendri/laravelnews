 
  <template>

      <div class="container">
          <p class="error">{{ error }}</p>

          <p class="decode-result">Last result: <b>{{ result }}</b></p>

          <b-alert v-model="showDismissibleAlert" variant="success" dismissible>
            <b>{{ result }}</b>
          </b-alert>

          <qrcode-stream @decode="onDecode" @init="onInit" />
    </div>
  </template>


<script>
  import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader';
  import Navbar from "./navbarold.vue";
  export default {
    name:'camera',
      components: {
        QrcodeStream,
        QrcodeDropZone,
        QrcodeCapture,  
        Navbar
    },
    data () {
      return {
        result: '',
        error: '',
        showDismissibleAlert:false,
      }
    },
    methods: {
          onDecode (result) {
            this.showDismissibleAlert = true
           this.result = result
        }
    },
    async onInit (promise) {
      try {
        await promise
      } catch (error) {
        if (error.name === 'NotAllowedError') {
          this.error = "ERROR: you need to grant camera access permisson"
        } else if (error.name === 'NotFoundError') {
          this.error = "ERROR: no camera on this device"
        } else if (error.name === 'NotSupportedError') {
          this.error = "ERROR: secure context required (HTTPS, localhost)"
        } else if (error.name === 'NotReadableError') {
          this.error = "ERROR: is the camera already in use?"
        } else if (error.name === 'OverconstrainedError') {
          this.error = "ERROR: installed cameras are not suitable"
        } else if (error.name === 'StreamApiNotSupportedError') {
          this.error = "ERROR: Stream API is not supported in this browser"
        }
      }
    },
  }
</script>