// infinite scroll

let postTime = ''
let lastPostTime = ''
let lastFetch = ''

window.onscroll = function(){
    const bodyHeights = document.body.scrollHeight
    const scrollPoint = window.scrollY + window.innerHeight

    // nangkap nilai time terakhir
    postTime = document.getElementsByClassName('post-time')
    lastPostTime = postTime[postTime.length - 1].value
    
    if (scrollPoint >= bodyHeights){
        // fetch data dengan mengirim params time

        if(lastFetch != lastPostTime){
            lastFetch = lastPostTime
            fetch('loadmore/'+lastPostTime)
            .then(response => response.json())
            .then(data => {
                console.log('load more')
                console.log(data.post)
                        
                for(let i = 0; i < data.post.length; i++){
                    let newPost = renderPost(data.post[i])
                    document.getElementById('post-wrapper').insertAdjacentHTML('beforeend', newPost)
                }

            })
            .catch(err => console.log(err))
        }
    }
}

function getAvatar(user)
{
    let avatar_url = user.avatar != null ? "images/avatar/"+user.avatar : "https://ui-avatars.com/api/?size=128&name="+user.username

    return `<img class="rounded-circle" src="${avatar_url}" alt="${user.avatar}" width="40" height="40" class="rounded-circle">`
}

function renderPost(post)
{
    return `<div class="card card-primary mb-3">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="me-2">
                            ${getAvatar(post.user)}
                        </div>

                        <div>
                            <a href="/@${post.user.username}" style="text-decoration: none">@${post.user.username}</a>
                            <p class="text-muted mb-0">${post.created_at}</p>                                
                        </div>
                    </div>
    
                    <img src="/images/post/${post.image}" width="100%" height="512px" alt="${post.caption}" ondblclick="like(${post.id})" class="mb-3">
                   
                    <div class="d-flex justify-content-between">
                        <p id="post-count-${post.id}" class="mb-0">${post.likes_count} <span>Menyukai</span></p>
                        <p id="post-count-${post.id}" class="mb-0 float-end">${post.comments_count} <span>Komentar</span></p>
                    </div>
                    
                    <hr class="mb-0 mt-0">
                    
                    
                    <p class="mb-0">
                        <button class="btn ${post.is_like_btn} btn-sm mt-2" onclick="like(${post.id})" id="post-like-${post.id}">
                             ${post.is_like}
                        </button>
                
                        <a href="/post/${post.id}" class="btn btn-primary btn-sm mt-2">Komentar</a>
                    </p>
                
                    <p class="caption mb-0">
                        ${(post.caption!=null) ? post.caption : ""}    
                    </p>
                </div>
            </div>
            <input type="hidden" class="post-time" value="${post.post_time}">`
}


function like(post_id, type="post")
{
    let btnLike = document.getElementById(type+'-like-' + post_id) 
    let count = document.getElementById(type+'-count-'+post_id)
    
    fetch('/like/' +type+ '/' + post_id)
    .then(response => response.json())
    .then(data => {
        console.log(data.message)

        let btnText = (data.message == 'like') ? 'Unlike' : 'Like'
        let classText  = (data.message == 'like') ? 'btn btn-danger btn-sm mt-2' : 'btn btn-primary btn-sm mt-2' 
        btnLike.innerText = btnText
        
        if(type=="post"){
            btnLike.className = classText
        }

        let currentCount = 0
        if(data.message == 'like'){
            currentCount = parseInt(count.innerText) + 1
        }
        else {
            currentCount = parseInt(count.innerText) - 1
        }

        console.log(currentCount)
        if(type=="post"){
            count.innerText = currentCount + ' Menyukai'
        }
        else {
            count.innerText = currentCount
        }
    });
}

// cari # dari caption
document.querySelectorAll('.caption').forEach(function(el){
    let renderText = el.innerHTML.replace(/#(\w+)/g, "<a href='/search?query=%23$1'>#$1</a>")
    el.innerHTML = renderText
})