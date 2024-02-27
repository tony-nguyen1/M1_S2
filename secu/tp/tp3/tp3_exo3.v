Inductive Formula :=
  | Var : Formula          (* Variable propositionnelle *)
  | Not : Formula -> Formula      (* Négation *)
  | And : Formula -> Formula -> Formula   (* Conjonction *)
  | Or : Formula -> Formula -> Formula    (* Disjonction *)
  | Imp : Formula -> Formula -> Formula   (* Implication *)
  | Equ : Formula -> Formula -> Formula.  (* Équivalence *)


(* Inductive formulLogique (n:Type) :  Type -> Prop :=
  | formuleOU : formuleLogqiue a b.
 *)

Fixpoint sub (F : Formula) {struct F} : list Formula :=
  match F with
  | Var => Var::nil
  | Not F' => F' :: sub F'
  | And P Q => P :: Q :: sub P ++ sub Q
  | Or P Q => P :: Q :: sub P ++ sub Q
  | Imp P Q => P :: Q :: sub P ++ sub Q
  | Equ P Q => P :: Q :: sub P ++ sub Q
  end.


Fixpoint nbc (F : Formula) {struct F} : nat :=
  match F with
  | Var => 0
  | Not F' => 1 + nbc F'
  | And P Q => 1 + nbc P + nbc Q
  | Or P Q => 1 + nbc P + nbc Q
  | Imp P Q => 1 + nbc P + nbc Q
  | Equ P Q => 1 + nbc P + nbc Q
  end.

