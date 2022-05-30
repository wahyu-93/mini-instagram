function like(post_id)
{
    const btnLike = document.getElementById('btn-like-' + post_id) 

    fetch('/like/' + post_id)
    .then(response => response.json())
    .then(data => {
        console.log(data.message)

        let btnText = (data.message == 'like') ? 'Unlike' : 'Like'
        let classText  = (data.message == 'like') ? 'btn btn-danger btn-sm mt-2' : 'btn btn-primary btn-sm mt-2' 
        btnLike.innerText = btnText
        btnLike.className = classText
    });
}

// cari # dari caption
document.querySelectorAll('.caption').forEach(function(el){
    let renderText = el.innerHTML.replace(/#(\w+)/g, "<a href='/search?query=%23$1'>#$1</a>")
    el.innerHTML = renderText
})