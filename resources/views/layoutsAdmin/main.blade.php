<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" type="text/css" href="{{url('assets/css/style.css')}}"/>  --}}

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{url('assets/bootstrap/css/bootstrap.min.css')}}"/> 
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap.min.css')}}"/> 
       <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('assets/css/nifty.min.css') }}" rel="stylesheet">


    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset('assets/css/demo/nifty-demo-icons.min.css') }}" rel="stylesheet">


    {{-- Menu  --}}
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!--=================================================-->


    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{ asset('assets/plugins/pace/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/plugins/pace/pace.min.js') }}"></script>


    <!--Demo [ DEMONSTRATION ]-->

    {{-- ini aku hapuuus --}}
    <link href="{{ asset('assets/css/demo/nifty-demo.min.css') }}" rel="stylesheet">

    {{-- <link href="{{ asset('assets/plugins/morris-js/morris.min.css') }}" rel="stylesheet"> --}}

    

    @yield('style')

    @include('layoutsAdmin.header')
    </head>
    <body>
      <div id="container">
        @include('layoutsAdmin.nav')
        <div class="boxed">
          @yield('content')   
          @include('layoutsAdmin.sidebar2')
        
        <footer id="footer">
          @include('layoutsAdmin.footer')
        </footer>
      </div>
      </div>
         <!--JAVASCRIPT-->
    <!--=================================================-->

    <script src="{{ asset('assets/plugins/morris-js/morris.min.js') }}"></script>
  
    <script src="{{ asset('assets/plugins/morris-js/raphael-js/raphael.min.js') }}"></script>
    
  
  
    <!--Morris.js Sample [ SAMPLE ]-->
    <script src="{{ asset('assets/js/demo/morris-js.js') }}"></script>

    <!--jQuery [ REQUIRED ]-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="{{ asset('assets/js/nifty.min.js') }}"></script>

	<script src="{{url('assets/js/components/bootstrap.js')}}"></script>
    <!--Demo script [ DEMONSTRATION ]-->
    {{-- ini aku komen --}}
    {{-- <script src="{{ asset('assets/js/demo/nifty-demo.min.js') }}"></script> --}}
    
    <!--Flot Chart [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.min.js') }}"></script>
  	<script src="{{ asset('assets/plugins/flot-charts/jquery.flot.resize.min.js') }}"></script>
	  <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.tooltip.min.js') }}"></script>


    <!--Sparkline [ OPTIONAL ]-->
    <script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>


    <!--Specify page [ SAMPLE ]-->
    <script src="{{ asset('assets/js/demo/dashboard.js') }}"></script>


    {{-- Menu --}}
    <script src="{{ asset('assets/js/menu.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    @yield('script')

    <script>
      function validateForm(event) {
          var userName = document.getElementById("user_name").value;
          var userEmail = document.getElementById("user_email").value;
          var userPassword = document.getElementById("user_password").value;
          var userGender = document.getElementById("user_gender").value;
          var userPhoto = document.getElementById("user_photo").value;
          var roleId = document.getElementById("role_id").value;
          var tokenId = document.getElementById("user_token").value;
  
          var isFormValid = true;
  
          if (userName.trim() === "") {
              document.getElementById("usernameError").textContent = "Username tidak boleh kosong!";
              isFormValid = false;
          } else {
              document.getElementById("usernameError").textContent = "";
          }
  
          if (userEmail.trim() === "") {
              document.getElementById("emailError").textContent = "Email tidak boleh kosong!";
              isFormValid = false;
          } else {
              document.getElementById("emailError").textContent = "";
          }
  
          if (userPassword.trim() === "") {
              document.getElementById("passwordError").textContent = "Password tidak boleh kosong!";
              isFormValid = false;
          } else {
              document.getElementById("passwordError").textContent = "";
          }
  
          if (userGender === "") {
              document.getElementById("genderError").textContent = "Silakan pilih gender!";
              isFormValid = false;
          } else {
              document.getElementById("genderError").textContent = "";
          }
      if (userPhoto.trim() === "") {
          document.getElementById("photoError").textContent = "Silakan pilih foto!";
          isFormValid = false;
      } else {
          document.getElementById("photoError").textContent = "";
      }
  
      if (roleId === "") {
          document.getElementById("roleError").textContent = "Silakan pilih role!";
          isFormValid = false;
      } else {
          document.getElementById("roleError").textContent = "";
      }
      if (tokenId === "") {
          document.getElementById("tokenError").textContent = "Token tidak boleh kosong!";
          isFormValid = false;
      } else {
          document.getElementById("tokenError").textContent = "";
      }
  
      if (!isFormValid) {
          event.preventDefault(); // Menghentikan pengiriman form jika ada error
      }
  }
  </script>

<script>
    function validateForm(event) {
        var userName = document.getElementById("id_kategori").value;
        var userEmail = document.getElementById("nama_produk").value;
        var userPassword = document.getElementById("harga_produk").value;
        var userGender = document.getElementById("gambar_produk").value;
        var userPhoto = document.getElementById("diskon_produk").value;
        var isFormValid = true;

        if (userName.trim() === "") {
            document.getElementById("kategoriError").textContent = "Silahkan pilih kategori!";
            isFormValid = false;
        } else {
            document.getElementById("kategoriError").textContent = "";
        }

        if (userEmail.trim() === "") {
            document.getElementById("produkError").textContent = "Produk tidak boleh kosong!";
            isFormValid = false;
        } else {
            document.getElementById("produkError").textContent = "";
        }

        if (userPassword.trim() === "") {
            document.getElementById("hargaError").textContent = "Harga produk tidak boleh kosong!";
            isFormValid = false;
        } else {
            document.getElementById("hargaError").textContent = "";
        }

        if (userGender === "") {
            document.getElementById("gambarError").textContent = "Silakan pilih gambar!";
            isFormValid = false;
        } else {
            document.getElementById("gambarError").textContent = "";
        }
    if (userPhoto.trim() === "") {
        document.getElementById("diskonError").textContent = "Silahkan pilih diskon!";
        isFormValid = false;
    } else {
        document.getElementById("diskonError").textContent = "";
    }

    if (!isFormValid) {
        event.preventDefault(); // Menghentikan pengiriman form jika ada error
    }
}
</script>

<script>
    function validateForm(event) {
        var userName = document.getElementById("nama_kategori").value;
        var isFormValid = true;

        if (userName.trim() === "") {
            document.getElementById("nama_kategoriError").textContent = "Nama kategori harus diisi!";
            isFormValid = false;
        } else {
            document.getElementById("nama_kategoriError").textContent = "";
        }

    if (!isFormValid) {
        event.preventDefault(); // Menghentikan pengiriman form jika ada error
    }
}
</script>


{{-- modal --}}
<!-- Letakkan script JavaScript di bagian bawah dokumen HTML -->
<script>
    // Dapatkan semua elemen gambar
    const images = document.querySelectorAll('img[data-target^="modal"]');
  
    // Tambahkan event listener untuk setiap gambar
    images.forEach((image) => {
      image.addEventListener('click', () => {
        const targetModalId = image.getAttribute('data-target');
        const modal = document.getElementById(targetModalId);
  
        // Tampilkan modal
        modal.style.display = "block";
  
        // Fungsi untuk menutup modal ketika ikon close di klik
        modal.querySelector('.close').onclick = function () {
          modal.style.display = "none";
        }
  
        // Fungsi untuk menutup modal ketika area di luar modal di klik
        window.onclick = function (event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
      });
    });
  </script>
<script>
    function confirmDelete() {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            // If the user clicks "OK" in the confirmation dialog, proceed with the deletion
            // The default link behavior will be triggered, and the delete action will be performed
        } else {
            // If the user clicks "Cancel" in the confirmation dialog, do nothing
            event.preventDefault(); // Prevent the default link behavior
        }
    }
</script>

{{-- <!-- Add this within your HTML file, e.g., in the <head> section -->
    <script>
function updateTotalPrice(inputElement, hargaAditional) {
  const jumlahJasa = parseInt(inputElement.value);
  const hargaJasaElement = inputElement.closest('tr').querySelector('.harga-perkg');
  const diskonJasaElement = inputElement.closest('tr').querySelector('.diskon-jasa');
  const totalHargaSetelahDiskonElement = inputElement.closest('tr').querySelector('.total-harga-setelah-diskon');

 
  const hargaJasaText = hargaJasaElement.textContent.replace(/\./g, '').replace(',', '.');
  const hargaJasa = parseFloat(hargaJasaText);

  const diskonPersen = parseFloat(diskonJasaElement.textContent);

  const totalHargaAdditional =  hargaAditional * jumlahJasa ;
//   console.log("Harga Aditional:", hargaAditional);
  const totalHargaSebelumDiskon = hargaProduk * jumlahJasa;
//   const totalHargaAdditional = inputElement.closest('tr').querySelector('.harga-aditional'); // You can update this logic to calculate the additional price if needed
//   console.log(totalHargaAdditional);
  const diskonNominal = (totalHargaSebelumDiskon + totalHargaAdditional) * (diskonPersen / 100);
  const totalHargaSetelahDiskon = totalHargaSebelumDiskon + totalHargaAdditional - diskonNominal;
  

  // Update the total harga setelah diskon for this row
totalHargaSetelahDiskonElement.textContent = formatNumber(totalHargaSetelahDiskon);

  

  // Recalculate the overall total harga
  updateOverallTotal();
}

// Update the overall total harga element on the page
function updateOverallTotal() {
  const totalHargaElements = document.querySelectorAll('.total-harga-setelah-diskon');
  let totalSemuaHarga = 0;

  totalHargaElements.forEach((element) => {
    const totalHargaText = element.textContent.replace(/\./g, '').replace(',', '.');
    const totalHarga = parseFloat(totalHargaText);
    totalSemuaHarga += totalHarga;
  });

  const overallTotalElement = document.querySelector('.overall-total');
  overallTotalElement.textContent = formatNumber(totalSemuaHarga);

  // Update the value of the input field with the latest overall total harga
  const totalHargaDiskon = document.getElementById('total_harga_setelah_diskon');
  const totalHargaInput = document.getElementById('total_harga_input');
  totalHargaInput.value = formatNumber(totalSemuaHarga - int(totalHargaDiskon));
}

// Rest of the JavaScript code (updateTotalPrice and formatNumber functions)

// Calculate the initial overall total harga and set the value of the input field
updateOverallTotal();


function formatNumber(number) {
  return new Intl.NumberFormat('id-ID', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 0,
  }).format(number);
}

// Add event listeners for input elements with class "jumlah-produk"
const jumlahProdukInputs = document.querySelectorAll('.jumlah-jasa');
jumlahProdukInputs.forEach((input) => {
  input.addEventListener('input', function () {
    updateTotalPrice(input);
  });
});

// Calculate the initial overall total harga
// updateOverallTotal();
</script> --}}

<!-- Add this within your HTML file, e.g., in the <head> section -->
  <script>
    function updateTotalPrice(inputElement) {
      const jumlahJasa = parseInt(inputElement.value);
      const hargaJasaElement = inputElement.closest('tr').querySelector('.harga-perkg');
      const diskonJasaElement = inputElement.closest('tr').querySelector('.diskon-jasa');
      const totalHargaSetelahDiskonElement = inputElement.closest('tr').querySelector('.total-harga-setelah-diskon');
    
      const hargaJasaText = hargaJasaElement.textContent.replace(/\./g, '').replace(',', '.');
      const hargaJasa = parseFloat(hargaJasaText);
    
      const diskonPersen = parseFloat(diskonJasaElement.textContent);
    
      const totalHargaSebelumDiskon = hargaJasa * jumlahJasa;
    
      const diskonNominal = totalHargaSebelumDiskon * (diskonPersen / 100);
      const totalHargaSetelahDiskon = totalHargaSebelumDiskon - diskonNominal;
    
      // Update the total harga setelah diskon for this row
      totalHargaSetelahDiskonElement.textContent = formatNumber(totalHargaSetelahDiskon);
    
      // Recalculate the overall total harga
      updateOverallTotal();
    }
    
    // Update the overall total harga element on the page
    function updateOverallTotal() {
      const totalHargaElements = document.querySelectorAll('.total-harga-setelah-diskon');
      let totalSemuaHarga = 0;
    
      totalHargaElements.forEach((element) => {
        const totalHargaText = element.textContent.replace(/\./g, '').replace(',', '.');
        const totalHarga = parseFloat(totalHargaText);
        totalSemuaHarga += totalHarga;
      });
    
      const overallTotalElement = document.querySelector('.overall-total');
      overallTotalElement.textContent = formatNumber(totalSemuaHarga);
    
      // Update the value of the input field with the latest overall total harga
      const totalHargaDiskon = document.getElementById('total_harga_setelah_diskon');
      const totalHargaInput = document.getElementById('total_harga_input');
      totalHargaInput.value = formatNumber(totalSemuaHarga - totalHargaDiskon.value.replace(/\./g, '').replace(',', '.'));
    }
    
    // Calculate the initial overall total harga and set the value of the input field
    updateOverallTotal();
    
    function formatNumber(number) {
      return new Intl.NumberFormat('id-ID', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0,
      }).format(number);
    }
    
    // Add event listeners for input elements with class "jumlah-jasa"
    const jumlahJasaInputs = document.querySelectorAll('.jumlah-jasa');
    jumlahJasaInputs.forEach((input) => {
      input.addEventListener('input', function () {
        updateTotalPrice(input);
      });
    });
</script>
    



    <!--=================================================-->
  </body>
</html>