Livewire.on('submit-form', (data) => {
    const payload = data[0];

    document.getElementById('total_amount').value = payload.total_amount;
    document.getElementById('payment_method').value = payload.payment_method;

    document.getElementById('form').submit();
});
