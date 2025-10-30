<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypingTextSeeder extends Seeder
{
    public function run(): void
    {
        $texts = [
            // 🟢 EASY (≈50 words)
            ['mode' => 'easy', 'text' => "The quick brown fox jumps over the lazy dog. Typing is fun when words flow smoothly across the screen, helping you improve focus and speed every day."],
            ['mode' => 'easy', 'text' => "Practice makes perfect. The more you type, the faster your fingers move. Keep your eyes on the screen and stay calm while writing your best sentences."],
            ['mode' => 'easy', 'text' => "Typing games are a great way to learn and test your skills. Short sentences help build confidence and rhythm for longer challenges ahead."],

            // 🟡 MEDIUM (≈100 words)
            ['mode' => 'medium', 'text' => "Learning to type quickly takes patience and repetition. Each time you practice, your fingers memorize the keys a little more. Avoid looking at the keyboard, and focus on accuracy first. Once your accuracy improves, your speed will naturally increase. Remember, typing is not about racing but maintaining a steady rhythm that lets your thoughts move freely from your mind to the screen without interruption."],
            ['mode' => 'medium', 'text' => "Typing tests are a perfect way to evaluate your progress over time. Start with shorter texts and gradually challenge yourself with longer ones. The key is to remain consistent. If you practice daily for even fifteen minutes, you will notice a big difference in your comfort level and accuracy within a few weeks."],
            ['mode' => 'medium', 'text' => "Keyboard layouts can vary, but the basic principles of touch typing remain the same. Keep your hands in the correct home-row position and practice typing without looking down. Every mistake is an opportunity to learn, so don’t worry if you make errors. Over time, your muscle memory will make typing effortless."],

            // 🔴 HARD (≈150 words)
            ['mode' => 'hard', 'text' => "Typing quickly and accurately is an essential skill in the digital age. Professionals, writers, and students all rely on their ability to transfer thoughts into words efficiently. To become a true expert, you must develop both precision and rhythm. Practicing longer texts that include punctuation, numbers, and different sentence structures helps simulate real-world writing conditions. The challenge is not only to type without mistakes but also to maintain focus for extended periods. Even minor distractions can slow your progress, so create a calm workspace and let your fingers follow your thoughts naturally across the keyboard."],
            ['mode' => 'hard', 'text' => "When typing long passages, fatigue and tension can easily appear. The best way to prevent this is by maintaining proper posture and taking short breaks every few minutes. Stretch your fingers and wrists to avoid stiffness. Remember, typing efficiently means finding a balance between comfort and speed. Listen to the rhythm of your keystrokes; it should sound smooth and even, like music. Over time, the connection between your brain and your hands becomes seamless, allowing creativity to flow without delay or hesitation."],
            ['mode' => 'hard', 'text' => "Accuracy always comes before speed. If you focus too much on typing fast, errors will multiply and break your flow. Instead, type at a pace that allows you to think clearly. Gradually, your speed will rise as your brain becomes more familiar with each word and pattern. Think of typing as a conversation with your computer, where every keystroke expresses an idea. With enough dedication and patience, even the most complex texts become effortless to write."],

            // ⚫ HARDCORE (≈300 words)
            ['mode' => 'hardcore', 'text' => "Typing at a professional level requires not only physical dexterity but also mental endurance. The ability to stay focused for long periods while maintaining consistent speed and accuracy is what separates a casual typist from a master. Each paragraph you type becomes an exercise in discipline. You learn to ignore distractions, regulate your breathing, and synchronize your eyes with your fingers. Hardcore typing practice pushes you to your limits, forcing you to find balance between pressure and precision. Your fingers begin to move almost automatically, guided by the rhythm of your thoughts. At this level, typing transforms from a skill into an art form, where each stroke of a key feels intentional and expressive. The challenge lies not only in keeping pace but in sustaining clarity throughout. As your typing stamina grows, so does your confidence in handling any task that requires rapid written communication."],
            ['mode' => 'hardcore', 'text' => "Advanced typing is like running a marathon — endurance and rhythm matter more than raw speed. You cannot sprint for hours, and you cannot type mindlessly for too long without losing focus. Hardcore typing requires a steady flow of attention and adaptability. When faced with complex sentences or unfamiliar words, the skilled typist maintains composure and consistency. Every correction becomes part of the learning process. Over time, you’ll notice that your thoughts align naturally with the pace of your typing, creating a seamless bridge between idea and execution. This connection is what makes expert typists appear almost effortless in their craft."],
            ['mode' => 'hardcore', 'text' => "In the realm of professional typing, mastery comes through deliberate practice. Each session refines your timing, rhythm, and attention to detail. The longer you type without losing focus, the more your mind enters a state of flow. Hardcore typists often describe this as meditative — a balance of concentration and calm awareness. To achieve this state, eliminate unnecessary distractions, adjust your workspace ergonomically, and challenge yourself with diverse texts. Whether you’re copying literature, writing code, or transcribing speech, the essence remains the same: precision and persistence. Every letter counts, every word matters, and every sentence strengthens your command of language and focus."],
        ];

        DB::table('typing_text')->insert($texts);
    }
}
