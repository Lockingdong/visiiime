@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
    <section class="py-20">
        <div class="container px-4 mx-auto">
            <div class="max-w-2xl mx-auto">
                <h2 class="mb-10 text-3xl font-semibold font-heading">服務條款</h2>

                <div ng-bind-html="trustedHtml" class="ng-binding">
                    <p>歡迎來到Visiiime。感謝您使用「Visiiime」服務(以下稱「本服務」)，本服務提供平台讓您串連所有社群媒體及拓展相關業務，您使用 Visiiime
                        和我們所提供的其他產品、功能、應用程式、服務、技術及軟體（以下簡稱「Visiiime 產品」或「產品」）時，均受到本《服務條款》規範，但若我們明示另有適用條款（且本《服務條款》不適用）者，不在此限。
                    </p>
                    <p>請繼續閱讀以下條款，以確認您了解使用我們的網站、產品、服務和應用程式（“服務”）的規則和限制。如果您對這些條款或服務有任何問題、意見或疑慮，請通過 <a
                            href="mailto:visiiimecorp@gmail.com">visiiimecorp@gmail.com</a> 與我們聯繫。</p>
                    <p>注意：請仔細閱讀這些條款。它們涵蓋有關向您提供的服務以及我們向您收取的任何費用、稅費和費用的重要信息。這些條款包括有關這些條款的未來更改、責任限制、集體訴訟豁免以及通過仲裁而不是在法庭上解決爭議的信息。
                    </p>
                    <h4>會員服務條款</h4>
                    <h5>一、定義</h5>
                    <ul>
                        <li>會員：本會員服務條款所稱之「會員」，為經由本網站註冊流程並通過認證之使用者。</li>
                    </ul>
                    <h5>二、服務內容</h5>
                    <ul>
                        <li>本服務是由本公司我們通過網站（或不時通過任何其他方式，包括應用程序）提供的服務，允許您創建頁面；對於使用者註冊本服務之申請，本公司保留是否接受的權利。</li>
                        <li>(本服務代收交易款項及代付交易款項的方式及範圍，以本公司提供服務當時所指定的服務方式及範圍為準；本服務代收交易款項及代付交易款項的服務方式及範圍有增減、變更或修改時，本公司將公佈於相關網頁上，不另行通知。)
                        </li>
                        <li>用戶以登入方式使用本服務，僅得以申請註冊時所設定的帳號，及其所對應的密碼，經由本公司當時所建置之登入方式及程序，登入使用本服務，且用戶帳號及其所對應之密碼，僅供註冊該帳號之用戶自行使用，用戶不得以任何有償或無償之方式透露、轉讓或提供予任何第三人使用。
                        </li>
                    </ul>
                    <h5>三、註冊、帳號、密碼與安全性</h5>
                    <ul>
                        <li>若您使用本服務，與本服務有關之事項，您和本公司都同意以電子文件為表示方法，如前開電子文件內容可完整呈現且可於日後取出供查驗者，其效力與書面文件相同；本公司電腦系統將自動紀錄相關電子交易資料，您可經由網路於登入系統後自行查詢相關交易資料，若您發現交易資料不正確，應立即通知本公司。
                        </li>
                        <li>要訪問或使用Visiiime服務，您必須在我們這裡創建一個帳戶。創建此帳戶時，您必須擔保在註冊及使用本服務過程中所提供予本公司的資料、以及所留存的資料，均為完整、正確、與當時情況相符的資料，如果該等資料事後有變更，您必須即時通知本公司；若事後發現有資料不符、或資料有變更而未即時通知本公司，本公司有權隨時取消或暫停您所取得之帳號及密碼外，並可以隨時拒絕對您提供本服務全部或一部分之服務及功能，且本公司不因此而承擔任何責任。
                        </li>
                        <li>對於您所取得的帳號和密碼，您必須負妥善保管和保密的義務，且不得以任何有償或無償之方式透露或提供予任何第三人登錄或使用。您將對與您的帳戶或密碼相關的活動負全部責任。您必須在發現任何安全漏洞或未經授權使用您的帳戶時立即通知我們。
                        </li>
                        <li>您不得將他人的姓名（例如，知名人士的姓名或與您沒有任何關係的姓名）、品牌或實體用戶名，或受其他人或實體的任何權利約束的商號，或具有攻擊性、粗俗、淫穢的名稱，進行使用。如果在使用特定用戶名時出現問題，例如其他人聲稱您的用戶名盜用了他們的姓名，我們將合理考慮情況並可能要求您更改用戶名（然後我們可能會重新分配您的用戶名）。如果我們要求您這樣做而您拒絕，我們可能會暫停或取消您的用戶帳戶。重要的是，在不影響上述內容的情況下，我們不允許“域名搶注”、“域名停放”或類似行為，我們可能會收回和重新分配我們有理由認定是有目的而創建的用戶名。
                        </li>
                        <li>您不得使用您的用戶帳戶或允許可能（在我們看來）對 Visiiime服務或聲譽造成損害、侵犯任何第三方權利、違反任何適用的法律或法規</li>
                        <li>如果您發現或懷疑您的帳號密碼被其他人冒用或不當使用，應立即 通知本公司
                            (客服聯絡信箱為全日全年無休)，以便於本公司及時採取適當的因應措施；但除本合約另有約定外，上述因應措施不得解釋為本公司因此而明示或默示對您負有任何形式之賠償或補償義務。在本公司主動獲悉、或因為您的通知而知悉您的帳號密碼被冒用或不當使用後，本公司將立即通知您並暫停該帳號所指示之支付行為、同時暫停接受該帳號後續之支付指示。用戶完成通報帳號密碼被冒用手續後所發生之損失，由本公司負擔；用戶辦理帳號密碼被冒用手續前所發生之損失，全部由用戶自行負擔，但以下列情形為限：<br>
                            (1) 用戶未妥善保管帳號密碼。<br>
                            (2) 用戶自行將帳號密碼提供與他人。<br>
                            (3) 用戶未使用本公司所提供之帳號安全機制。<br>
                            (4) 其他因用戶之故意或重大過失所致之事由。</li>
                        <li>本公司為調查用戶帳號密碼被冒用所生之費用，由本公司負擔。</li>
                    </ul>
                    <h5>四、發佈內容</h5>
                    <ul>
                        <li>您可以在您使用
                            Visiiime創建的頁面上發佈、鏈接、儲存、共享或以其他方式提供某些信息、內文、圖片、影片或其他資訊。您需對發佈的內容負責，包括其合法性、可靠性和適當性。如果是第三方所擁有任何內容，您有責任確保您擁有所有權限或權利允許您的頁面和
                            Visiiime服務上提供該內容（包括任何許可）。</li>
                        <li>通過將內容發佈到
                            Visiiime時，您同時授予Visiiime服務使用、公開展示、全球性、免權利金、非專屬之權利及使用權，得處理、貯藏、儲存、歸檔、編輯索引、抓取照片、影片或圖像（包括個人肖像、公司
                            Logo…等），創設影片、圖像、文字 及內容之演算系統，將照片、影片、圖像、文字及內容電腦碼修改或轉變為適當之媒體格式、標準或媒介，使之成為
                            Visiiime服務或相關行銷活動內容一部分，並且己確認您擁有發佈內容所需的第三方權利和許可。您保留對您對Visiiime服務提交、發佈或顯示的任何內容的任何和所有權利，並且有責任保護這些權利。您同意該許可包括我們將您的內容提供給
                            Visiiime服務的其他用戶的權利，這些用戶也可以根據這些服務條款使用您的內容。</li>
                        <li>您同意發佈內容是您的或您有權使用它並授予Visiiime服務條款中規定之權利和許可；在Visiiime服務上發佈您的內容不會侵犯任何人的隱私權、公開權、版權、合同權或任何其他權利。此外，您同意：
                        </li>
                        <li>(1)內容不會導致您或我們違反任何法律、法規、規則、準則或其他法律義務；</li>
                        <li>(2)內容不會或不能被合理地視為淫穢、不適當、誹謗、貶低、不雅、煽動性、攻擊性、威脅性、辱罵性、容易煽動種族仇恨、歧視性、褻瀆性、違反保密或隱私。在某些情況下，在一個國家/地區不會違反先前要求的內容在另一個國家/地區可能會這樣做（並且我們保留在此類情況下採取我們認為必要的任何行動的權利，包括刪除內容或限制對
                            Visiiime服務的訪問）；</li>
                        <li>(3)內容不會具有誤導性或欺騙性，並且您不會將某些虛假內容陳述為事實；</li>
                        <li>(4)內容不會是未經請求的、未公開的或構成任何產品的未經授權的廣告或認可；</li>
                        <li>(5)內容不包含軟件病毒或任何其他中斷、破壞或限制任何計算機軟件、硬件或電信設備功能的計算機代碼、文件或程式；</li>
                        <li>(6)內容不會使Visiiime服務名譽掃地。</li>
                        <li>您同意保存所有必要的記錄，以證明您的內容不違反本<strong>第 6 條</strong>的任何要求，並因應我們的合理要求提供此類記錄。</li>
                        <li>我們沒有義務定期監控您發佈在 Visiiime服務的內容之準確性或可靠性。但我們保留隨時修改或刪除任何內容的權利。</li>
                        <li>您承認並同意您在 Visiiime服務上提供的所有內容都將是公開信息，並且您願意承擔此類公開披露所涉及的風險。</li>
                        <li>我們可能會選擇在我們的網站上展示您的頁面和內容（但不是您的註冊商標或個人信息，除非您書面同意）或以其他方式推廣
                            Visiiime服務。您授予我們免版稅的、全球性的、永久許可，以將此類內容用於此類目的。</li>
                    </ul>
                    <h5>五、條款和 Visiiime服務的變更</h5>
                    <ul>
                        <li>為了遵守法律、或出於合理的商業原因需要調整Visiiime的服務或添加功能，我們可以隨時更改或替換這些服務條款，以保護我們的合法利益。 </li>
                        <li>如果這些服務條款的更動可能對您產生重大負面影響，我們將盡最大努力提前通知您更改（例如，通過在網站上提供通知），我們將爭取在任何新條款生效前至少 1 個月通知您。 </li>
                        <li>您有責任不定時檢查服務條款是否有任何更改。如果您不同意這些服務條款的任何更改，您有責任停止使用 Visiiime服務或根據<strong>第 3 條</strong>取消。 </li>
                        <li>當您繼續使用 Visiiime服務將被視為您接受對這些服務條款的任何更改，如上所述。</li>
                        <li>您同意當 Visiiime服務在不斷發展，我們可能會不時更改 Visiiime服務的部分內容及其功能。</li>
                    </ul>
                    <h5>六、使用期限</h5>
                    <ul>
                        <li>如果您選擇的是免費計劃，將在您接受服務條款時開始，直到您選擇刪除帳戶為止。</li>
                        <li>如果您選擇的是付費計劃，並且接受服務條款開始，付費計劃將一直持續直到您到賬單頁面上取消您的付費計劃。</li>
                        <li>(1)您的付費計劃將持續到當前計費周期結束。</li>
                        <li>(2)在計費周期結束時，您的付費計劃將自動轉換為免費計劃</li>
                        <li>如果您選擇了付費計劃，並在<strong>72小時內</strong>於賬單頁面上取消付費計劃時：</li>
                        <li>(1)我們將盡快全額退還您當月預付的費用。</li>
                        <li>(2)您的付費計劃將在您取消時終止並自動轉換為免費計劃。</li>
                        <li>**如果您的付費計劃有年度計費周期：
                            **- (1) 我們將盡快向您退還相當於您預先支付的 11 個月的年費；和
                            **- (2) 您的付費計劃將在您取消該計劃的日曆月末結束，並將自動轉換為免費計劃。 </li>
                        <li>當您不想再使用免費計劃並希望永久刪除您的帳戶時，您可以E-mail至「visiiimecorp@gmail.com」請相關人員協助您刪除帳戶。但請注意，如果您這樣做，將無法重新激活您的帳戶，也將無法檢視您添加的任何內容或信息。
                        </li>
                        <li>請注意，這些服務條款允許我們有權利在某些情況下暫停或取消您的免費計劃或付費計劃(<strong>例如，參見第 16
                                條</strong>)。此外，如果我們沒有收到您的付費計劃的款項時，我們將保留取消您的付費計劃的權利。</li>
                    </ul>
                    <h5>七、可接受用途範圍</h5>
                    <ul>
                        <li>您對 Visiiime服務的訪問和使用受這些服務條款皆適用法律法規的約束。我們致力於確保
                            Visiiime服務對所有用戶都是安全的，並且不會為不當內容或用戶行為提供平台。如果第三方（包括任何執法機構）提出您的行為可能違反了這些服務條款的任何真實且合理的指控，我們保留與該第三方合作的權利。
                        </li>
                        <li>若您違反以下任何一點，我們將暫停或停用您的使用權限：</li>
                        <li>(1)如果您沒有完全能力和法律能力同意這些服務條款，則不得訪問或使用 Visiiime服務；</li>
                        <li>(2)未經授權複製、修改、改編、翻譯、<strong>逆向工程</strong>、反彙編、反編譯、從
                            Visiiime服務或包含任何內容提取信息或創建其衍生作品，包括任何文件、表格或文檔（或其中的任何部分）或確定或試圖確定 Visiiime服務或
                            Visiiime服務的任何衍生作品所體現的任何源代碼、算法、方法或技術（或授權任何其他人代表您這樣做）；</li>
                        <li>(3)分發、許可、轉讓或出售任何 Visiiime服務或其任何衍生作品的全部或任何部分，但在我們明確同意的情況下，您可以將
                            Visiiime服務轉售給有限類別的人以書面形式向您提供此類活動（並且，如果我們同意，我們還可能包含此類同意的條件，您必須遵守）；</li>
                        <li>(4)有償推銷、出租或租賃 Visiiime服務，或使用 Visiiime服務做廣告或進行任何商業招攬，除非您可以在我們明確同意的情況下向有限類別的人推銷
                            Visiiime服務以書面形式向您提出此類活動；</li>
                        <li>(5)未經我們明確書面同意，將 Visiiime服務用於任何商業或未經授權的目的，包括傳播或促進任何商業廣告或招攬或垃圾郵件；</li>
                        <li>(6)干擾或試圖干擾 Visiiime服務的正常運行，破壞本網站或連接到 Visiiime服務的任何網絡，或繞過我們可能用來阻止或限制訪問 Visiiime服務的任何措施；</li>
                        <li>(7)將 Visiiime服務或其任何部分合併到任何其他程序或產品中，除非我們另行書面同意；</li>
                        <li>(8)使用或授權他人使用<strong>自動腳本</strong>或其他抓取工具從您的主頁或 Visiiime服務收集信息，或以其他方式與 Visiiime服務互動；</li>
                        <li>(9)冒充任何人或實體，或虛假陳述或以其他方式歪曲您或您與任何人或實體的從屬關係，包括給人的印像是您上傳、發布、傳輸、分發或以其他方式提供的任何內容來自 Visiiime服務；</li>
                        <li>(10)在您的主頁、您的帳戶、或通過您主頁上的任何鏈接恐嚇或騷擾他人，或宣揚基於種族、性別、宗教、國籍、殘疾、性取向或年齡的暴力或歧視；</li>
                        <li>(11)在您的主頁或您的帳戶中包含任何色情材料（包括圖片和語言）；</li>
                        <li>(12)在未經我們授權的情況下使用或試圖使用他人的帳戶、服務或系統，或在 Visiiime服務上創建虛假身份；</li>
                        <li>(13)以可能產生利益衝突或破壞 Visiiime服務目的的方式使用 Visiiime服務，例如與其他用戶交易評論或撰寫或索取虛假評論；</li>
                        <li>(14)使用 Visiiime服務以任何方式上傳、傳輸、分發、存儲或以其他方式提供：<ol>
                                <li>包含病毒、木馬、蠕蟲、邏輯炸彈或其他惡意或技術上有害的材料的文件；</li>
                                <li>Visiiime認為構成未經請求或未經授權的廣告、招攬、宣傳材料、“垃圾郵件”、“多層次營銷”、“連鎖信”、“金字塔計劃”或任何被禁止的招攬形式的任何信息；</li>
                                <li>所有第三方的任何私人信息，包括地址、電話號碼、電子郵件地址、個人身份證件中的號碼和特徵（例如國民保險號碼、護照號碼）或信用卡號碼，隱私政策中規定的我們除外；</li>
                                <li>任何侵犯或可能侵犯任何其他人的版權、商標或其他知識產權或隱私權的內容；</li>
                                <li>任何誹謗任何人，或淫穢、冒犯、仇恨或煽動性的內容；</li>
                                <li>任何會構成、鼓勵或指導刑事犯罪、危險活動或自殘的內容；</li>
                                <li>任何故意激怒或對抗人們的內容，尤其是拖釣和欺凌，或旨在騷擾、傷害、傷害、恐嚇、困擾、尷尬或不安的人；</li>
                                <li>任何包含任何形式威脅的內容，包括身體暴力威脅；</li>
                                <li>任何種族主義或歧視性內容，包括基於某人的種族、宗教、年齡、性別、殘疾或性取向的歧視；</li>
                                <li>您沒有獲得適當許可或沒有資格提供的任何答案、回應、評論、意見、分析或建議；</li>
                                <li>我們自行判斷令人反感或限製或禁止任何其他人使用 Visiiime服務，或可能使我們、Visiiime服務或我們的用戶面臨任何類型的任何傷害或責任的內容。</li>
                            </ol>
                        </li>
                    </ul>
                    <h5>八、費用款項及權利義務</h5>
                    <ul>
                        <li>當您同意使用付費計劃時，須向我們支付計劃費用外，並同意遵守以下約定：</li>
                        <li>當您選擇信用卡消費，您同意授權
                            Visiiime依您選擇之服務內容及扣款方式，自您指定之信用卡帳戶扣款。選擇續繳制之使用者，你應同意Visiiime之第三方金流服務商對您的財務變式資訊進行儲存，並依照您所同意與授權的方式進行使用。
                        </li>
                        <li>Visiiime收費方式為月繳型、年繳型。會員一經付費後，不得以任何理由要求退費或按比例折讓。<strong>如有特殊情況需辦理退費，例如：重複購買同品項等，您需承擔部分手續費。</strong>
                        </li>
                        <li>月繳型、年繳型將透過您消費的信用卡帳單每月、每年向您收取，刷卡付費完成後即可開通使用。若無法自您的信用卡帳戶扣款，將會暫時取消您的付費方案或加購項目功能。啟用後將每月或每年持續收費，未申請終止自動扣繳前，視為同意繼續使用。
                        </li>
                        <li>應使用本人之信用卡或付款工具，若您使用非本人（下稱「實際付款人」）之信用卡或其所持有之付款工具（如：小額付款帳戶）進行付款，Visiiime視為您已獲得合法授權使用，實際付款人亦完全知悉此付款行為。您或實際付款人將來得查詢與付款相關之會員帳戶資訊、終止付費或僅屬於實際付款人個人之資料異動。
                        </li>
                        <li>如你或實際付款人任一方有違法之虞或遭任一方向
                            Visiiime舉報，Visiiime將依照本條款，對您及實際付款人的個人資料進行適當蒐集及處理該筆付費資料。您或實際付款人皆不得違反本條款或侵害第三人之權益，違者將自負相關法律責任。
                        </li>
                        <li>其付款人（即使用者本人或實際付款人）使用信用卡付款時，其指定之信用卡過期、掛失、被往來銀行拒絕或因其他原因致
                            Visiiime請款失敗時，Visiiime有權終止或解除雙方交易，Visiiime無義務需提前告知。</li>
                        <li>其付款人皆應盡善良管理人之注意，妥善保管個人資料與所提供信用卡或第三方付費服務之重要資料，不得洩漏或交付與第三人，如因您或實際付款人之故意或過失使他人知悉、或遭第三人冒用該重要資料，而造成損失時，應自行負責，與
                            Visiiime無涉。</li>
                        <li>如你對當期應繳之費用有疑義時，Visiiime仍得自指定之信用卡帳戶扣除帳單所列之金額。如確實有溢繳或繳款不足之情形時，則本公司將於下期帳單中自動扣除或增列相關費用。</li>
                        <li>關於付款人與當地電信業者、第三方服務商或代收服務商付款機制之糾紛，包含且不限於付款帳戶之變更、異動等情形，皆屬獨立於本條款以外的法律關係，應由付款人及該服務提供商雙方各自協調解決，並自行負擔相關法律責任。
                        </li>
                        <li>如需終止付費方案，您需聯繫我們提出終止自動扣繳，回到一般會員<strong>（需至少 2
                                個工作日）</strong>，當目前的計費週期完結時，就不會再進行任何付費（月繳方案會在下一個月生效*）。</li>
                        <li><strong>如需更改付費方案，您需聯繫我們終止您既有付費方案的自動扣繳（需至少 2
                                個工作日），再前往購買方案，選擇您想更改的方案並完成付款，我們會停止您既有付費方案的自動扣繳，其既有方案未使用到的天數會自動加總至您的新方案，此期間您的會員權益不會受到影響。</strong>
                        </li>
                        <li>根據「通訊交易解除權合理例外情事適用準則」第二條第五款之規定，Visiiime之付費方案，一經您授權扣款購買即為完成服務，不適用消費者保護法第十九條第一項通訊交易七日解除權之規定。</li>
                    </ul>
                    <h5><strong>九、知識產權</strong></h5>
                    <ul>
                        <li>Visiiime服務、網站及其內容（不包括您的內容，但包括 Visiiime內容）、特性和功能中的所有知識產權是我們（或我們的許可方）專有的財產，您不會質疑此類所有權。 </li>
                        <li>Visiiime服務受中華民國的版權、商標和其他法律保護。未經我們事先書面同意，不得將我們的商標和商品名稱用於任何產品或服務。這些服務條款中的任何內容均不構成我們向您轉讓任何知識產權。
                        </li>
                        <li>您只能在我們授權的情況下使用 Visiiime服務（包括按照這些條款和條件使用）。作為用戶，您被授予有限的、非排他性的、可撤銷的、不可轉讓的權利來使用
                            Visiiime服務來創建、顯示、使用、播放和上傳受這些服務條款約束的內容。</li>
                        <li>您不得將 Visiiime服務用於與我們無關或以任何方式使我們名譽掃地的產品或服務。</li>
                        <li>任何其他用戶表達或提供的任何意見、建議、聲明、服務、優惠或其他信息或內容均屬於各自作者或分銷商的內容，而不是我們的內容。</li>
                        <li>如果我們向您提供任何圖像、圖標、視頻、圖形或其他內容（Visiiime內容）供您與 Visiiime服務相關使用，您必須： </li>
                        <li>(1) 僅在您的頁面上使用此類 Visiiime內容，不得在其他任何地方使用； </li>
                        <li>(2) 遵守與我們提供給您的 Visiiime內容相關的任何合理的書面指導方針或條款，這些指導方針或條款可能是第三方的指導方針或條款。 </li>
                    </ul>
                    <h5>十、隱私和數據監護</h5>
                    <ul>
                        <li>Visiiime服務根據您對Visiiime服務或內容（數據）歸我們所有，您不會對此類所有權提出異議。 </li>
                        <li>我們盡可能向您提供數據或數據的可視化，作為 Visiiime服務（數據分析）的一部分。我們對數據分析的準確性或完整性不作任何陳述或保證，但我們將盡力使其準確和完整。 </li>
                        <li>我們的隱私政策適用於我們收集、使用和披露您的個人信息的方式。 </li>
                    </ul>
                    <h5>十一、保密及安全性</h5>
                    <ul>
                        <li>如果我們與您共享有關 Visiiime服務的機密信息，或合理的人認為機密的信息，您必須對其保密並採取合理的安全措施以防止未經授權的披露或訪問該信息。 </li>
                        <li>如果您選擇透過向我們發送有關新產品、服務、功能、修改、增強、內容、產品、促銷、計算機代碼或任何其他資訊的任何想法來為 Visiiime服務做出貢獻（反饋），那麼無論您的通信內容如何：</li>
                        <li>(1) 我們沒有義務以任何理由審查、考慮或實施您的反饋或將任何反饋的全部或部分退還給您；</li>
                        <li>(2) 反饋是在非機密的基礎上提供的，我們沒有義務對您發送的任何反饋保密或不以任何方式使用或披露它；</li>
                        <li>(3) 您不可撤銷地授予我們永久的、不可撤銷的、可轉讓的全球免版稅許可，以復制、分發、創建衍生作品、修改、執行、向公眾傳播、提供、展示以及以其他方式使用和利用反饋及其衍生品用於任何目的。
                        </li>
                    </ul>
                    <h5>十二、個人資料保護法</h5>
                    <ul>
                        <li>
                            <p>對於您的個人資料，本公司將依個人資料保護法等相關法令之規定，保護個人資料安全，除依法令規定或主管機關之要求、或為履行契約義務、或使用者可能涉及違反法令或侵害第三人權益、違反本約定條款或其他約定事項、或經用戶本人同意以外，本公司不會將用戶之個人資料及其交易訊息揭露或提供予第三人。關於個人資料保護及隱私權政策，請參閱本公司的
                                隱私權聲明。</p>
                        </li>
                        <li>
                            <p>為適切提供本服務，本公司將與相關交易網站、<strong>信用卡收單機構</strong>等第三人(以下稱協力廠商)合作或使用協力廠商所提供之服務，<strong>包括但不限於透過相關交易網站完成用戶註冊、信用卡收單機構完成用戶所委託之交易款項收付事宜</strong>，為核對或確認用戶身份、履行合約、完成或提供相關交易或服務之目的，您同意協力廠商得將所需之個人資料揭露或提供予本公司、本公司亦得將個人資料揭露或提供予協力廠商。
                            </p>
                        </li>
                        <li>
                            <p>若您使用本服務，即表示同意並授權本公司得在必要範圍內，將您的部分個人資料揭露予與您交易的另一方。</p>
                        </li>
                        <li>
                            <p>為配合「信用卡收單機構簽訂『提供代收代付服務平台業者』為特約商店自律規範」，用戶同意，本公司得依合作之信用卡收單機構（即本條第2項之協力廠商）之作業要求將用戶之個人資料提供予<strong>財團法人金融聯合徵信中心</strong>；實際提供資料之範圍、類別、特定目的及其期間等事項，依信用卡收單機構當時所定者為準。
                            </p>
                        </li>
                        <li>
                            <p>在下列情況下，本公司將查看用戶的個人資料，包括但不限於交易記錄及電信紀錄等，並得提供予相關政府機關、或主張其權益受侵害並提出合理事證之第三人，必要時並得暫停該用戶之帳號、存取權限、及對該用戶暫停提供本服務之全部或一部：
                            </p>
                        </li>
                        <li>
                            <p>(1) 依法令規定、或依司法機關或其他相關政府機關之命令或要求；</p>
                        </li>
                        <li>
                            <p>(2) 為執行本約定條款、或使用者有違反本約定條款或其他約定事項或侵害第三人權益之虞；</p>
                        </li>
                        <li>
                            <p>(3) 為維護本服務系統之安全或經營者之合法權益；</p>
                        </li>
                        <li>
                            <p>(4) 為保護其他使用者或其他第三人的合法權益；</p>
                        </li>
                        <li>
                            <p>(5) 為維護本服務系統的正常運作。 </p>
                        </li>
                        <li>
                            <p>利用期間自您使用本服務日起至本服務停止提供服務之日止。</p>
                        </li>
                        <li>
                            <p>利用地區、對象及方式：</p>
                        </li>
                        <li>
                            <p>台灣地區及服務使用地，且基於履行契約義務，將提供相關資料予合作特約商或 Visiiime於特定目的範圍內委外之廠商。</p>
                        </li>
                        <li>
                            <p>Visiiime將於蒐集之特定目的範圍內處理並利用個人資料。</p>
                        </li>
                        <li>
                            <p>合作特約廠商及委外廠商僅於累兌點數及行銷之特定目的範圍內蒐集、處理或利用個人資料。 </p>
                        </li>
                        <li>
                            <p>接受定期或不定期 Visiiime的訊息。如日後無此需求，可自行來信 Visiiime客服中心取消。</p>
                        </li>
                    </ul>
                    <h5>十三、您對最終用戶的責任</h5>
                    <ul>
                        <li>您的主頁可能有自己的訪問者和客戶（我們稱為最終用戶）。最終用戶於您的頁面或您發佈的內容進行其互動之行為（不屬於這些服務條款中就
                            Visiiime服務本身對您承擔的義務）將完全由您負責。此責任包括遵守與最終用戶有關的所有法律和法規，以及向最終用戶提供產品和服務。</li>
                    </ul>
                    <h5>十四、其他責任</h5>
                    <ul>
                        <li>您同意我們不對因使用 Visiiime服務，或從 Visiiime服務複製、分發或下載內容而遭受的任何損害負責。</li>
                        <li>在任何情況下，您或我們均不對任何間接的、懲罰性的、特殊的、附帶的或後果性的損害（包括業務損失、收入、利潤、使用、隱私、數據、商譽或其他經濟利益），無論是由於違約還是侵權（包括疏忽），即使相關方事先已被告知可能發生此類損害。
                        </li>
                        <li>您全權負責對與您使用 Visiiime服務相關的數據、內容和設備進行充分的安全保護和備份，並且不會對因使用
                            Visiiime服務而導致數據丟失、重新運行時間、指令不准確、工作延誤或利潤損失。您不得將您的帳戶轉讓或以其他方式處置給任何其他人。</li>
                        <li>您將賠償我們因您違反這些服務條款（<strong>包括第 7 條</strong>) 或第三方就您的內容向我們提出索賠而給我們造成的任何損失。
                            在任何情況下，我們根據這些服務條款或 Visiiime服務對您的責任都不會超過您在據稱發生責任時實際支付給我們的費用中的較高者，<strong>或
                                [$100]。無論您對我們提出的索賠是基於合同、疏忽、其他侵權行為還是其他原因，此限制均適用。</strong></li>
                    </ul>
                    <h5>十五、服務暫停或中斷</h5>
                    <ul>
                        <li>本公司於下列情形得暫停或中斷本服務之全部或一部，用戶不得因此請求賠償或補償：</li>
                        <li>(1) 對本服務相關軟硬體設備進行搬遷、更換、升級、保養或維修時；</li>
                        <li>(2) 使用者有任何違反法令、本約定條款或本服務相關約定之情形；</li>
                        <li>(3) 因第三人之行為、非本公司所得以控制之事項、或其他不可歸責於本公司之事由所致之服務暫停、中斷或無法正常運作；</li>
                        <li>(4) 天災或其他不可抗力所致之服務暫停、中斷或無法正常運作。</li>
                        <li>本服務如因本公司軟硬體設備障礙、阻斷、或不正常運作，以致發生錯誤、遲滯、中斷或不能傳遞時，本公司應儘速排除相關障礙並恢復系統正常運作，但除本公司有故意或重大過失者外，本公司不負損害賠償責任。
                        </li>
                        <li>你同意因您的操作不良或非法操作而造成的損失，Visiiime不負責任，您應當自行承擔一切因自身行為而直接或間接導致的法律責任。</li>
                    </ul>
                    <h5>十五之一、資訊安全</h5>
                    <ul>
                        <li>本公司及用戶應各自確保其資訊系統之安全，防止非法入侵、取得、竄改、毀損業務紀錄或用戶之個人資料。</li>
                        <li>第三人破解本公司資訊系統之保護措施或利用資訊系統之漏洞所生之爭議，由本公司就該事實不存在負舉證責任。</li>
                        <li>第三人入侵本公司資訊系統對用戶所造成之損害，由本公司負擔。</li>
                    </ul>
                    <h5>十六、免責聲明</h5>
                    <ul>
                        <li>您使用
                            Visiiime服務的風險由您自行承擔。Visiiime服務按“原樣”和“可用”提供。Visiiime服務不提供任何形式的明示或暗示保證，**包括但不限於正常運行時間或可用性，或對適銷性、特定用途適用性、不侵權或性能過程的暗示保證。
                        </li>
                        <li>我們和許可方不保證及聲明：</li>
                        <li>(1) Visiiime服務將不間斷或安全地運行，或在任何特定時間或地點可用；</li>
                        <li>(2) 任何錯誤或缺陷將得到糾正；</li>
                        <li>(3) Visiiime服務沒有病毒或其他有害成分；</li>
                        <li>(4) 使用Visiiime服務的結果將符合您的要求。</li>
                        <li>本免責聲明適用於因任何性能故障、錯誤、遺漏、中斷、刪除、缺陷、操作或傳輸延遲、計算機病毒、通信線路故障、盜竊、與
                            Visiiime服務的使用或操作有關的記錄的破壞或未經授權的訪問或更改或使用，無論是違反合同、侵權行為、疏忽或任何其他訴訟原因。</li>
                        <li>我們不對 Visiiime服務中包含的內容的完整性、準確性、可靠性、適用性或可用性作出任何類型的明示或暗示的陳述或保證出於任何目的。因此，您對此類信息的任何依賴完全由您自己承擔風險。</li>
                        <li>我們對 Visiiime服務的有效性或盈利能力或 Visiiime服務的運行不會中斷或無錯誤不作任何明示或暗示的保證、陳述或保證。我們不對
                            Visiiime服務中的任何中斷或錯誤造成的後果負責。</li>
                        <li>我們有時可能會作為 Visiiime服務的一部分或附屬於對第三方提供的特定功能或其他服務（例如，支付門戶）的訪問。 </li>
                        <li>這些服務條款（<strong>包括本第十四條的上述規定</strong>）在法律允許的最大範圍內適用。這些服務條款中的任何內容均不排除、限制或修改您在任何法律下可能擁有的權利，這些權利不得通過協議排除、限制或修改。如果這些服務條款受《中華民國消費者保護法》管轄，我們對您未能遵守與任何服務有關的消費者保證的責任僅限於重新提供服務或代替此類重新提供的付款。
                        </li>
                        <li>我們可能會不時在測試版中向您提供 Visiiime服務的某些功能（並且此功能將被標記為“測試版”或類似功能）。我們仍在評估和測試此類 Beta 功能，它可能不如我們
                            Visiiime服務的其他部分可靠。 </li>
                        <li>**最終用戶同意，通過 Visiiime的“支持我”鏈接向用戶進行的捐贈是自願進行的，不換取任何商品或服務。處理這些付款的服務由第三方提供（參見第 15 條）。</li>
                    </ul>
                    <h5>十七、停用及問題解決的權利</h5>
                    <ul>
                        <li>如果您不遵守這些服務條款中的任何一項（<strong>特別是第 7 條（可接受的使用）和第 9 條（知識產權）</strong>），我們可能會暫停或取消您的用戶帳戶或限制您訪問的
                            Visiiime服務功能之權限。一段情況下，我們會視情況使用此權利，如果您的帳戶重複不合乎規定或嚴重違規的情況下，我們會使用此權利，。 </li>
                        <li>如果您對我們根據<strong>第 16(a)
                                條作出的決定</strong>、Visiiime在服務上的執行或與這些服務條款有關的其他事項有任何疑問，請立利透過電子郵件visiiimecorp@gmail.com（問題通知）通知我們。一旦我們收到問題通知，您和我們將盡一切合理努力真誠地解決問題。**在我們從收到通知之日起至少花費
                            1 個月的時間試圖解決問題之前，我們都不會就該問題提起任何法律訴訟或採取任何正式或公開的行動。 </li>
                    </ul>
                    <h5>十八、第三方服務</h5>
                    <ul>
                        <li>使用第三方工具之服務時，請確保商家對其熟悉度，並同意其使用條款；Visiiime無法監視或控制由第三方產生之結果。</li>
                        <li>為增加商家或消費者方便性，Visiiime提供連結至第三方工具之服務；此服務提供不表示 Visiiime認可第三方之服務內容，或與第三方有任何關係。</li>
                        <li>Visiiime提供連結的外部網站，Visiiime不保證其內容之合適性、即時性、有效性及正確性。</li>
                        <li>商家或消費者連結至 Visiiime提供連結的網站時，應自行決定是否離開；若商家或消費者連結至第三方網站而產生之任何損害，Visiiime不負任何損害賠償之連帶責任。</li>
                        <li>於使用第三方工具前，Visiiime建議商家或消費者事先充分瞭解第三方工具之所有細節。</li>
                        <li>商家應符合第三方工具業者所定之資格，並經該業者驗證通過後，始得使用之。如因可歸責於商家之事由致商家無法使用該服務時，概與本平台無涉。</li>
                    </ul>
                    <h5>十九、一般條款</h5>
                    <ul>
                        <li>你同意本服務條款之解釋或適用，以及與本服務條款有關之爭議，以中華民國法律為準據法，並以臺灣臺北地方法院為第一審管轄法院。</li>
                        <li>Visiiime未行使或執行本服務條款任何權利或規定，不構成前述權利或行使權之放棄。</li>
                        <li>本服務條款之部分規定，倘經有管轄權之法院認定為無效，當事人仍同意法院應努力使當事人於前開規定所表達之真義生效，且本服務條款之其他規定仍持續有效。</li>
                    </ul>
                </div>



            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
