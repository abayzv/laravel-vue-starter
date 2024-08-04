export default function formatDate(dateString: string) {
    const date = new Date(dateString);
    const formattedDate = new Intl.DateTimeFormat('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }).format(date);
    const formattedTime = new Intl.DateTimeFormat('id-ID', { hour: '2-digit', minute: '2-digit' }).format(date);

    return `${formattedDate} ${formattedTime}`;
}