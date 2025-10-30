<x-layout>

<x-slot:title>
Homepage
</x-slot:title>
<nav>




<center>
    <h2>Minigames</h2>
    <table border="1" cellpadding="10">
        <tr>
            <td>
                <a href="{{ route('memoryCard') }}">Memory Card</a>
            </td>
            <td>
                <a href="{{ route('typingGame') }}">Typing Game</a>
            </td>
        </tr>
    </table>
</center>


</nav>



</x-layout>