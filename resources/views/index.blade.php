<x-layout>

<x-slot:title>
Homepage
</x-slot:title>





<center>
    <h2>Minigames</h2>
    <x-nav />
    <table border="1" cellpadding="10">
        <tr>
            <td>
                <a href="{{ route('memoryCard') }}">Memory Card</a>

            </td>
            <td>

               <a href="{{ route('minigames.index') }}">Sākums</a>


            </td>
            <td>

             <a href="{{ route('typingSpeed') }}">Typing Game</a>


            </td>
            
        </tr>
    </table>
</center>






</x-layout>

