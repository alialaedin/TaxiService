<script>
  let submitButton = document.getElementById('submitButton');
  let mobile = document.getElementById('mobile');
  let errorSpan = document.getElementById('errorSpan');

  mobile.addEventListener('input', function () {

    if (this.value.length >= 11) {
      submitButton.removeAttribute('disabled');
      submitButton.classList.remove('btn-light');
      submitButton.classList.add('btn-primary');
    } else {
      submitButton.setAttribute('disabled', 'true');
      submitButton.classList.remove('btn-primary');
      submitButton.classList.add('btn-light');
    }
  });

  submitButton.addEventListener('click', function (e) {

    e.preventDefault();

    if (isNaN(mobile.value) || !mobile.value.startsWith('09')) {
      errorSpan.style.display = 'block';
      errorSpan.innerText = 'شماره موبایل صحیح نمی باشد!';
    } else if (mobile.value.length < 11 || mobile.value.length > 11) {
      errorSpan.style.display = 'block';
      errorSpan.innerText = 'شماره موبایل باید 11 رقم باشد!';
    } else {
      sendToken(mobile.value, e);
    }

  });
</script>
