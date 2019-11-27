       $('#editar').hide();
        recarga();
    $(document).ready(function(){
        updateForm();
        addForm();
        getProdutos();
        delProd();
        recarga();

    });
    function updateForm(){
        $('#updateForm').submit(function(e) {
            e.preventDefault();
            const id = $('#idEdit').val();
            // console.log(id);
            const nome = $('#nomeEdit').val();
            const precoCompra = $('#precoEdit').val();
            const dataEntrada = $('#dataEdit').val();
            $.ajax({
                url: 'http://localhost:8000/produto/'+id, // caminho para o script que vai processar os dados
                type: 'PUT',
                data: {"nome": nome, "precoCompra": precoCompra, "dataEntrada": dataEntrada, "_token": "{{ csrf_token() }}"},
                success: function(response) {
                    $('#resp').html(response);
                    $('#editar').hide();
                    recarga();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                    console.log(status)
                }
            });
            return false;
        });
    };
    function delProd(){
        $('#delProd').submit(function(e) {
            e.preventDefault();
            // const id = $('#delId').val();
            // const url = "{{route('produto.destroy',"+id+")}}";
            // const urla = "http://localhost:8000/produtar/"+id;
            // $.ajax({
            //     url: urla, // caminho para o script que vai processar os dados
            //     type: 'DELETE',
            //     success: function() {
            //         recarga();
            //         // $('#editar').hide();
            //     },
            //     error: function(xhr, status, error) {
            //         alert(xhr.responseText);
            //         console.log(status)
            //     }
            // });
            // return false;
            // recarga();
        });
    };
        function addForm(){
        $('#addForm').submit(function(e) {
            e.preventDefault();
            const url = "{{route('produto.store')}}";
            // console.log(id);
            const nome = $('#nomeAdd').val();
            const precoCompra = $('#precoAdd').val();
            const dataEntrada = $('#dataAdd').val();
            $.ajax({
                url: url, // caminho para o script que vai processar os dados
                type: 'POST',
                data: {"nome": nome, "precoCompra": precoCompra, "dataEntrada": dataEntrada, "_token": "{{ csrf_token() }}"},
                success: function(response) {
                    $('#nomeAdd').val('');
                    $('#precoAdd').val('');
                    $('#dataAdd').val('');
                    recarga();
                    // $('#editar').hide();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                    console.log(status)
                }
            });
            return false;
            recarga();
        });
    };
    function editar(id){
        getProduto(id);

    };

    function getProduto(id){
        $.ajax({
            url: 'http://localhost:8000/produtar/'+id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data){
                // console.log(data);
                $('#nomeEdit').val(data.nome);
                $('#precoEdit').val(data.precoCompra);
                $('#dataEdit').val(data.dataEntrada);
                $('#idEdit').val(data.id);
                $('#editar').show();
                recarga();

                // console.log(data.dataEntrada);
            },
            error: function(data){
                alert('No response from server');
            }
        });
    };
    function getProdutos(){
        $.ajax({
            url: 'http://localhost:8000/produto/',
            type: 'GET',
            dataType: 'JSON',
            success: function(data){

                // console.log(data.dataEntrada);
            },
            error: function(data){
                alert('No response from server');
            }
        });
    };
    function recarga(){
         $.ajax({
            url: 'http://localhost:8000/home/home',
            type: 'GET',
            dataType: 'html',
            success: function(data){
                $('#meusProd').html(data);
                 // console.log(data);
            },
            error: function(data){
                alert('No response from server');
            }
        });
    }
