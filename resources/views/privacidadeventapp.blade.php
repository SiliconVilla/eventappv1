@extends('layouts.app')

@section('content')

<style type="text/css">
    .w-5 {
        width: 7%;
    }

    .h-5 {
        width: 7%;
    }
    w-5 h-5
</style>


            <div class="card">
                <div class="card-header">{{ __('POLÍTICA DE PRIVACIDAD') }}</div>
                
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    

<p>La presente Política de Privacidad establece los términos en que EventAPP usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web o aplicativo, en cumplimiento de la regulación vigente y definir el marco de tratamiento de los datos de carácter personal que recoja, almacene, use y circule de conformidad de acuerdo a la Ley Estatutaria 1581 de 2012 y el Decreto 1074 de 2015. Estamos comprometidos con la seguridad de los datos de nuetsros usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.

<p><h5>Información que es recogida</h5> 

<br>Nuestro sitio podrá recoger información personal: Nombre, Documento de identidad, Correo Electrónico y Teléfono de Contacto. Así mismo cuando sea necesario podrá ser requerida información específica para continuar con algún proceso del sitio previa información al usuario.

<p><h5>Uso de la información recogida</h5>

<br>Nuestro sitio emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios y asistencias de participación a los diferentes eventos que se programen. La información de registro de asistencia será procesada de manera temporal y eliminada una vez se cargue la información a los sitemas de información pertinentes para cada caso SIBU y SINSU, la información será no se almacenará por más de un periodo académico. 

<p>EventAPP está altamente comprometido para cumplir con el compromiso de mantener su información segura. Nuestro sitio utiliza las medidas de seguridad adecuadas para proteger el acceso no autorizado a los datos que alamcena, garatizando su privacidad y protección.

<p><h5>Cookies</h5>

<br>Una cookie se refiere a un fichero que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente.

<br>Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente noticias.

<p><h5>Control de su información personal</h5>

<br>En cualquier momento usted puede restringir la recopilación o el uso de la información personal que es proporcionada a nuestro sitio web.

<p>Esta compañía no venderá, cederá, ni distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido con un orden judicial, entidades públicas o administrativas en ejercicio de sus funciones legales o a terceros autorizados por el titular o por la Ley.

<p>EventAPP Se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.

<p>Hemos adoptado esta Política de privacidad, que determina cómo procesamos la información recopilada por EventAPP, que también proporciona las razones por las que debemos recopilar ciertos datos personales sobre ti. Por lo tanto, debes leer esta Política de privacidad antes de usar el sitio web de EventAPP.

<p>Cuidamos tus datos personales y nos comprometemos a garantizar su confidencialidad y seguridad.

<p>Puedes visitar el sitio sin decirnos quién eres ni revelar ninguna información por la cual alguien pueda identificarte como una persona específica. Sin embargo, si deseas utilizar algunas de las funciones del sitio web, o deseas recibir nuestro boletín informativo o proporcionar otros detalles al completar un formulario, puedes proporcionarnos datos personales, como tu correo electrónico, nombre, apellido, y número de teléfono. Puedes optar por no proporcionar tus datos personales, pero es posible que no puedas aprovechar algunas de las funciones del sitio web.

<p><h5>Tus derechos:</h5>

<br>El derecho a ser informado.
<br>El derecho de acceso.
<br>El derecho a la rectificación.
<br>El derecho a borrar.
<br>El derecho a restringir el procesamiento.
<br>El derecho a la portabilidad de datos.

<br>Si deseas ejercer tus derechos, comunícate con nosotros a través de la información de contacto a continuación:

Correspondencia: Comunicación dirigida al Oficial de Protección de Datos Personales; Dirección: Transversal 31E # 4E-06, Palmira Valle del Cauca.
Correo electrónico: asocia2.co@gmail.com
Teléfono: 319 3271243

<br>La socitud será tramitada dentro de los 10 días hábiles siguientes a la recepción de la misma.

<p><h5>Enlaces a otros sitios web:</h5>
<br>Nuestro sitio puede contener enlaces a otros sitios web que no son de nuestra propiedad ni están controlados por nosotros. Ten en cuenta que no somos responsables de dichos sitios web ni de las prácticas de privacidad de terceros. Te recomendamos que estés atento cuando abandones nuestro sitio web y leas las declaraciones de privacidad de cada sitio que pueda recopilar información personal.

<p><h5>Seguridad de la información:</h5>
<br>Aseguramos la información que proporcionas en servidores informáticos en un entorno controlado y seguro, protegido del acceso, uso o divulgación no autorizados. Mantenemos medidas de seguridad administrativas, técnicas y físicas razonables para proteger contra el acceso no autorizado, el uso, la modificación y la divulgación de datos personales bajo su control y custodia.





                </div>
                <br>


            </div>
        
@endsection
