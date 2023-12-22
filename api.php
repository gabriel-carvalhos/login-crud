<script>
    const address = document.querySelectorAll('.address')
    const cep = document.querySelector('.cep')

    cep.addEventListener('blur', async () => {
        console.log(cep.value)
        const url = `https://viacep.com.br/ws/${cep.value}/json/`
        const res = await fetch(url)
        const dataRes = await res.json()
        autocomplete(dataRes)
    })

    const autocomplete = (data) => {
        if (data.erro) {
            console.error('erro')
        } else {
            address.forEach(item => {
                item.value = data[item.id]
            })
        }
    }
</script>