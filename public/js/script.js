$(function(){
    var $inputItemName   = $('input#item_nome');
    var $inputItemId     = $('input#item_id');
    var $inputQuantidade = $('input#quantidade');
    var $inputTotal      = $('input#total');
    var $inputImposto    = $('input#imposto');
    var $inputPreco      = $('input#preco');
    var $inputPercentual = $('input#percentual');
    var url              = '/venda/item';
    var $btnAdd          = $('#btn_add_item');
    var $btnTotalVenda   = $('#btn_total_venda');
    var $inputTotalResumo   = $('#input_total');
    var $inputImpostoResumo = $('#input_imposto');
    
    var configCurrency = {
        prefix: 'R$'
    };
    
    $inputTotal.inputmask('currency', configCurrency);
    $inputImposto.inputmask('currency', configCurrency);
    
    $inputItemName.typeahead({
        source: getSource,
        displayText: getDisplayText,
        afterSelect: afterSelect
    });
    
    $inputQuantidade.change(handlerQuantidade);
    
    $btnAdd.click(handlerAdicionar);
    
    $btnTotalVenda.click(handlerTotalVenda);
    
    /**
     * funções
     */
    function handlerTotalVenda() {
        var $this = $(this);
        var $form = $this.parent('form');
        
        var pro = $.post($form.attr('action'), $form.serialize()).promise();
        
        pro.done(function(d){
            console.log(d);
            $inputTotalResumo.val('Total da venda: R$'+d.total);
            $inputImpostoResumo.val('Total de imposto: R$'+d.imposto);
        }).fail(function(e){
            console.log(e);
        });
    };
    
    
    function calculo() {
        var preco      = window.parseFloat($inputPreco.val()).toFixed(2);
        var quantidade = window.parseFloat($inputQuantidade.val()).toFixed(2);
        var percentual = window.parseInt($inputPercentual.val());
        
        console.info('Preço :', preco);
        console.info('Quantidade: ', quantidade);
        console.info('Percentual: ', percentual);
        
        var total   = window.parseFloat(preco * quantidade).toFixed(2);
        var imposto = window.parseFloat(((preco / 100) * percentual) * quantidade).toFixed(2);
        
        console.info('Imposto: ', imposto);
        
        $inputTotal.val(total);
        $inputImposto.val(imposto);
    };
    
    function handlerQuantidade() {
        calculo();
    };
    
    function afterSelect(item) {
        $inputItemId.val(item.id);
        $inputQuantidade.val('1');
        $inputPreco.val(item.preco);
        $inputPercentual.val(item.percentual);
        $inputQuantidade.trigger('change');
    };
    
    function getDisplayText(item) {
        return item.nome;
    };
    
    function getSource(query, process) {
        var pro1 = $.post(url, {query : query}, false, 'json').promise();
        pro1.done(function(data){
            process(data);
        });
    };
    
    function handlerAdicionar() {
        var $form = $('#vendaItem');
        var data  = $form.serialize();
        var url   = '/venda-item';
        var pro   = $.post(url, data, false).promise();
        
        $form.trigger('reset');
        
        pro.done(function(d){
            var $table = $('#tableDo tbody');
            var html   = [];
            for (var i in d) {
                html[i] = '<tr>'+
                            '<td>'+d[i].nome+'</td>'+
                            '<td>'+d[i].quantidade+'</td>'+
                            '<td>'+d[i].total+'</td>'+
                            '<td>'+d[i].imposto+'</td>'+
                          '</tr>';
            }
            $table.empty().html(html);
        }).fail(function(e){
           console.log(e); 
        });
    };
    
});
