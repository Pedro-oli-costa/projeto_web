let carrinho = [];
let total = 0;



function addCarrinho(nome,preco){
    const produto = { nome, preco};
    total += preco;
    carrinho.push(produto);
    alert("Produto adicionado no Carrinho");
    console.log(carrinho);
    exibirCarrinho();
}


function removerProduto(index) {
    if (index > -1) {
        total -= carrinho[index].preco; 
        carrinho.splice(index, 1); 
        exibirCarrinho(); 
    }
}


function exibirCarrinho() {
    const carrinhoElement = document.getElementById('carrinho');
    carrinhoElement.innerHTML ="";

    carrinho.forEach((produto,index) => {
        const li = document.createElement('li');
        li.textContent = `${produto.nome} - R$${produto.preco.toFixed(2)}`;
        carrinhoElement.appendChild(li);


    const buttonRemover = document.createElement('button');
        buttonRemover.textContent = 'Remover';
        buttonRemover.onclick = () => removerProduto(index); 

        li.appendChild(buttonRemover);
        carrinhoElement.appendChild(li);

    });

    document.getElementById('total').textContent = `Total: R$${total.toFixed(2)}`;
}

function formularioenviado(){
    alert("formulario enviado com sucesso")
}


