const cautraloi = document.querySelectorAll('.theAnswer')
const submitBtn = document.getElementById('submit')
const quiz = document.getElementById('quiz')
let socaudung  = 0
let currentQuiz = 0
let score = 0
question_load()

function startGame() {
    let startDiv = document.getElementById('start')
    startDiv.style.display = "none"
    quiz.style.display = "block"
    question_load()
}

function question_load() {
    
    submitBtn.disabled = true
    remove_ans()
    
    fetch('http://localhost:8080/restful_api/api_controller/quiz/read.php')
    .then(res => res.json())
    .then(data => {
        document.getElementById('total_correctAns').value = data.quest.length
        // alert(document.getElementById('total_correctAns').value)
        const quiz = document.getElementById('title')
        const a_theAnswer = document.getElementById('a_theAnswer')
        const b_theAnswer = document.getElementById('b_theAnswer')
        const c_theAnswer = document.getElementById('c_theAnswer')
        const d_theAnswer = document.getElementById('d_theAnswer')
        //showing the question and the answer
        const get_quest = data.quest[currentQuiz]

        // console.log(get_quest)
    
        quiz.innerText = get_quest.title
    
        a_theAnswer.innerText = get_quest.quest_a
        b_theAnswer.innerText = get_quest.quest_b
        if (get_quest.quest_c!=null) {
            document.getElementById('cau_c').classList.remove('displayAnswer')
            c_theAnswer.innerText = get_quest.quest_c
        }else{
            document.getElementById('cau_c').classList.add('displayAnswer')
        }
        if (get_quest.quest_d!=null) {
            document.getElementById('cau_d').classList.remove('displayAnswer')
            d_theAnswer.innerText = get_quest.quest_d
        }else{
            document.getElementById('cau_d').classList.add('displayAnswer')
        }
        document.getElementById('correct_answer').value = get_quest.correct_ans
        // alert(document.getElementById('correct_answer').value)
    })
    .catch(error => console.log(error));
}

function get_answer(){
    let answer = undefined
    cautraloi.forEach((cautraloi) => {
        if (cautraloi.checked) {
            answer = cautraloi.id
        }
    })
    return answer;
}

function remove_ans() {
    cautraloi.forEach((cautraloi) => {
        cautraloi.checked = false
    })
}

cautraloi.forEach((elem) => {
    elem.addEventListener("change", function(event) {
        submitBtn.removeAttribute("disabled")
    })
})


submitBtn.addEventListener("click", () => {
    const answered = get_answer()
    // console.log(answered)
    if (answered) {
      if (answered === document.getElementById('correct_answer').value) {
        socaudung++
        score++
      }
    }
        currentQuiz++
        question_load()

      if (currentQuiz < document.getElementById('total_correctAns').value) {
        question_load()
      } else {
        const total_Ans = document.getElementById('total_correctAns').value      
        if (socaudung === 6) {
            quiz.innerHTML = `
            <h2>Champions, you just got ${socaudung}/${total_Ans} quest</h2>
            <p>Your score: ${score} points</p>
            <img src=\"../image/comdlpng6934977-removebg-preview.png" width=\"100%\" height=\"450px\">
            <button class="btn btn-primary" onclick="location.reload()" style='padding: 10px;margin: 0 auto;display: block;'>Replay</button>
            `
        } else if (socaudung === 5) {
            quiz.innerHTML = `
            <h2>You have to do better than that, you finished ${socaudung}/${total_Ans} quest</h2>          
            <p>Your score: ${score} points</p>
            <img src=\"../image/Untitled-design-15-3-removebg-preview.png" width=\"100%\" height=\"450px\">
            <button class="btn btn-primary" onclick="location.reload()" style='padding: 10px;margin: 0 auto;display: block;'>Replay</button>
            `
        } else {
            quiz.innerHTML = `
            <h2>Shame on you, you only get ${socaudung}/${total_Ans} quest</h2>           
            <p>Your score: ${score} points</p>
            <img src=\"../image/England-v-Iceland-removebg-preview.png" width=\"100%\" height=\"450px\">
            <button class="btn btn-primary" onclick="location.reload()" style='padding: 10px;margin: 0 auto;display: block;'>Replay</button>
            `
        }
      }
})

